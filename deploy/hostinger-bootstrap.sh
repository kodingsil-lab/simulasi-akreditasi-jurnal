#!/usr/bin/env bash
set -Eeuo pipefail

DEPLOY_SCRIPT="${HOME}/hostinger-deploy.sh"
SOURCE_URL="https://raw.githubusercontent.com/kodingsil-lab/simulasi-akreditasi-jurnal/main/deploy/hostinger-deploy.sh"

command -v curl >/dev/null 2>&1 || { echo "curl tidak tersedia." >&2; exit 1; }
curl --fail --location --silent --show-error "${SOURCE_URL}" --output "${DEPLOY_SCRIPT}"
chmod 700 "${DEPLOY_SCRIPT}"
exec "${DEPLOY_SCRIPT}"
