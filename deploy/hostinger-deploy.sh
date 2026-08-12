#!/usr/bin/env bash
set -Eeuo pipefail

APP_NAME="simulasi-akreditasi-jurnal"
REPOSITORY_URL="https://github.com/kodingsil-lab/simulasi-akreditasi-jurnal.git"
BRANCH="main"
DOMAIN="simulasi-arjuna.unisap.ac.id"

HOME_DIR="${HOME}"
APP_ROOT="${HOME_DIR}/apps/${APP_NAME}"
SOURCE_DIR="${APP_ROOT}/source"
SHARED_DIR="${APP_ROOT}/shared"
PUBLIC_DIR="${HOME_DIR}/domains/${DOMAIN}/public_html"
ENV_FILE="${SHARED_DIR}/.env"

log() { printf '\n[%s] %s\n' "$(date '+%Y-%m-%d %H:%M:%S')" "$*"; }
fail() { printf '\nDEPLOY GAGAL: %s\n' "$*" >&2; exit 1; }

command -v git >/dev/null 2>&1 || fail "Git tidak tersedia."
command -v php >/dev/null 2>&1 || fail "PHP CLI tidak tersedia."
command -v composer >/dev/null 2>&1 || fail "Composer tidak tersedia."

[[ "$(php -r 'echo PHP_MAJOR_VERSION.".".PHP_MINOR_VERSION;')" == 8.2* || "$(php -r 'echo PHP_VERSION_ID;')" -ge 80200 ]] \
    || fail "PHP 8.2 atau lebih baru diperlukan."

mkdir -p "${APP_ROOT}" "${SHARED_DIR}" "${PUBLIC_DIR}"

case "${PUBLIC_DIR}" in
    "${HOME_DIR}"/domains/*/public_html) ;;
    *) fail "Document root tidak aman: ${PUBLIC_DIR}" ;;
esac

if [[ ! -f "${ENV_FILE}" ]]; then
    cat > "${ENV_FILE}" <<ENV
CI_ENVIRONMENT = production
app.baseURL = 'https://${DOMAIN}/'
app.forceGlobalSecureRequests = true

database.default.hostname = localhost
database.default.database = GANTI_DATABASE
database.default.username = GANTI_USERNAME
database.default.password = GANTI_PASSWORD
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306

security.csrfProtection = 'session'
cookie.secure = true
cookie.httponly = true
cookie.samesite = 'Lax'
ENV
    chmod 600 "${ENV_FILE}"
    fail "Template ${ENV_FILE} telah dibuat. Isi kredensial database, lalu jalankan script ini lagi."
fi

grep -q 'GANTI_' "${ENV_FILE}" && fail "Kredensial pada ${ENV_FILE} belum diisi."

if [[ ! -d "${SOURCE_DIR}/.git" ]]; then
    log "Mengambil source code"
    git clone --branch "${BRANCH}" --single-branch "${REPOSITORY_URL}" "${SOURCE_DIR}"
else
    log "Memperbarui source code"
    git -C "${SOURCE_DIR}" fetch origin "${BRANCH}"
    git -C "${SOURCE_DIR}" checkout "${BRANCH}"
    git -C "${SOURCE_DIR}" pull --ff-only origin "${BRANCH}"
fi

ln -sfn "${ENV_FILE}" "${SOURCE_DIR}/.env"
mkdir -p "${SHARED_DIR}/writable/cache" "${SHARED_DIR}/writable/debugbar" "${SHARED_DIR}/writable/logs" "${SHARED_DIR}/writable/session" "${SHARED_DIR}/writable/uploads"

if [[ ! -f "${SHARED_DIR}/writable/.htaccess" ]]; then
    cp "${SOURCE_DIR}/writable/.htaccess" "${SHARED_DIR}/writable/.htaccess"
fi
if [[ ! -f "${SHARED_DIR}/writable/index.html" ]]; then
    cp "${SOURCE_DIR}/writable/index.html" "${SHARED_DIR}/writable/index.html"
fi
for directory in cache debugbar logs session uploads; do
    if [[ ! -f "${SHARED_DIR}/writable/${directory}/index.html" ]]; then
        cp "${SOURCE_DIR}/writable/${directory}/index.html" "${SHARED_DIR}/writable/${directory}/index.html"
    fi
done

rm -rf "${SOURCE_DIR}/writable"
ln -sfn "${SHARED_DIR}/writable" "${SOURCE_DIR}/writable"

log "Memasang dependensi production"
(cd "${SOURCE_DIR}" && composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader)

log "Menjalankan migration dan sinkronisasi rubrik"
(cd "${SOURCE_DIR}" && php spark migrate --all && php spark db:seed RubricSeeder)

log "Mengaktifkan document root domain"
find "${PUBLIC_DIR}" -mindepth 1 -maxdepth 1 ! -name '.well-known' -exec rm -rf -- {} +
cp -a "${SOURCE_DIR}/public/." "${PUBLIC_DIR}/"

sed -i "s#require FCPATH . '../app/Config/Paths.php';#require '${SOURCE_DIR}/app/Config/Paths.php';#" "${PUBLIC_DIR}/index.php"

chmod 755 "${APP_ROOT}" "${SOURCE_DIR}" "${SHARED_DIR}" "${SHARED_DIR}/writable"
find "${SOURCE_DIR}" -type d -exec chmod 755 {} +
find "${SOURCE_DIR}" -type f -exec chmod 644 {} +
find "${SHARED_DIR}/writable" -type d -exec chmod 775 {} +
find "${SHARED_DIR}/writable" -type f -exec chmod 664 {} +
chmod 600 "${ENV_FILE}"

log "Deploy selesai"
printf 'URL: https://%s/\nCommit: %s\n' "${DOMAIN}" "$(git -C "${SOURCE_DIR}" rev-parse --short HEAD)"
