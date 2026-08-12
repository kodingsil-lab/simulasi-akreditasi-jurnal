<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/svg+xml" href="<?= base_url('favicon.svg') ?>?v=2">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title><?= esc($title ?? 'Simulasi Akreditasi Jurnal') ?></title>
    <style>
        :root{font-family:'Inter',system-ui,sans-serif;color:#172033;background:#f3f6fa;--navy:#173f75;--navy-dark:#10325f;--blue-soft:#dcecff;--sidebar-width:276px}
        *{box-sizing:border-box}html,body{min-height:100%}body{margin:0;background:#f3f6fa;font-weight:400}button,input,textarea,select{font:inherit}h1,h2,h3{font-weight:700}label{font-weight:500}
        .sidebar{position:fixed;z-index:20;inset:0 auto 0 0;width:var(--sidebar-width);padding:22px 18px 18px;display:flex;flex-direction:column;color:#fff;background:linear-gradient(180deg,#173f75 0%,#153968 100%);box-shadow:10px 0 32px rgba(19,48,86,.1)}
        .brand{display:flex;align-items:center;gap:12px;padding:3px 7px 20px;border-bottom:1px solid rgba(255,255,255,.12)}
        .brand-mark{width:43px;height:43px;flex:none;display:grid;place-items:center;border-radius:13px;background:linear-gradient(145deg,#5a9de4,#85c1ff);box-shadow:0 7px 18px rgba(4,27,57,.22);color:#fff}
        .brand-mark svg{width:23px;height:23px}.brand-copy strong{display:block;font-size:.95rem;line-height:1.35;font-weight:700}.role-pill{display:inline-flex;margin-top:5px;padding:3px 7px;border-radius:999px;background:rgba(255,255,255,.12);color:#ddebff;font-size:.68rem;font-weight:600;letter-spacing:.03em;text-transform:capitalize}
        .menu-label{margin:22px 11px 8px;color:#91b5df;font-size:.67rem;font-weight:600;letter-spacing:.11em;text-transform:uppercase}.nav-section-label{display:block;margin:18px 11px 6px;color:#91b5df;font-size:.62rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase}.sidebar nav{flex:1;min-height:0;overflow-y:auto;padding-right:2px}.nav-link{position:relative;display:flex;align-items:center;gap:12px;min-height:48px;margin:4px 0;padding:10px 12px;color:#dceaff;text-decoration:none;border:1px solid transparent;border-radius:11px;font-size:.88rem;font-weight:500;transition:background .16s,border-color .16s,transform .16s,color .16s}.nav-link:hover{color:#fff;background:rgba(255,255,255,.09);transform:translateX(2px)}.nav-link.active{color:#fff;background:rgba(255,255,255,.14);border-color:rgba(255,255,255,.13);box-shadow:0 7px 17px rgba(7,31,63,.13)}.nav-link.active::before{content:"";position:absolute;left:-7px;width:3px;height:24px;border-radius:0 4px 4px 0;background:#72d8aa}.nav-icon{width:34px;height:34px;flex:none;display:grid;place-items:center;border-radius:9px;background:rgba(255,255,255,.08);color:#cfe3fb}.nav-link.active .nav-icon{background:#fff;color:#17477d}.nav-icon svg{width:18px;height:18px}.nav-text{line-height:1.25}.nav-lock{margin-left:auto;display:grid;place-items:center;width:24px;height:24px;border-radius:7px;background:rgba(255,255,255,.09);color:#aac3df}.nav-link.locked{color:#a9c0da}.nav-link.locked:hover{transform:none}.nav-link.locked .nav-icon{opacity:.78}
        .profile{margin-top:15px;padding:13px;border:1px solid rgba(255,255,255,.12);border-radius:14px;background:rgba(6,31,61,.2)}.profile-row{display:flex;align-items:center;gap:10px;min-width:0}.avatar{width:38px;height:38px;flex:none;display:grid;place-items:center;border-radius:11px;background:#e9f3ff;color:#17477d;font-weight:700}.profile-copy{min-width:0}.profile-name{display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;font-size:.79rem;font-weight:600}.profile-caption{display:block;margin-top:3px;color:#a9c4e2;font-size:.68rem}.logout-form{margin:11px 0 0}.logout-button{width:100%;min-height:39px;display:flex;align-items:center;justify-content:center;gap:8px;border:1px solid rgba(255,255,255,.18);border-radius:9px;background:rgba(255,255,255,.08);color:#fff;font-weight:600;font-size:.79rem;cursor:pointer;transition:.16s}.logout-button:hover{background:#fff;color:#17477d}.logout-button svg{width:16px;height:16px}
        .main{margin-left:var(--sidebar-width);padding:30px;min-height:100vh;max-width:none}.card{background:#fff;padding:1.5rem;border-radius:12px;box-shadow:0 2px 12px #17203314}.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1rem}.hero{background:linear-gradient(125deg,#173b6c,#2862a5);color:#fff}.metric{border-left:4px solid #4f9cf9}.metric strong{font-size:1.8rem;display:block;margin-top:.4rem}.step{border:1px solid #dbeafe;box-shadow:none}.step h3{margin-top:0}.action-group{display:flex;align-items:center;justify-content:flex-end;gap:.45rem}.action-group form{margin:0}.action-group .button,.action-group button{min-width:64px;text-align:center;padding:.55rem .65rem}.danger{background:#b42318}label{display:block;margin-top:.75rem}input,textarea,select{width:100%;padding:.65rem .75rem;border:1px solid #cbd5e1;border-radius:8px;margin-top:.25rem}button,.button{display:inline-flex;align-items:center;justify-content:center;min-height:42px;background:#173b6c;color:#fff;border:0;border-radius:8px;padding:.6rem .85rem;text-decoration:none;cursor:pointer;font-weight:650;line-height:1.2;transition:background .15s,border-color .15s,color .15s,box-shadow .15s}button:focus-visible,.button:focus-visible,input:focus-visible,select:focus-visible,textarea:focus-visible{outline:3px solid rgba(52,120,197,.2);outline-offset:1px}table{width:100%;border-collapse:collapse;margin-top:1rem}th,td{padding:.7rem;border-bottom:1px solid #e2e8f0;text-align:left}tbody tr:last-child td{border-bottom:0}th{font-weight:600}.muted{color:#64748b}.error{color:#b42318}.flash{padding:.7rem;background:#ecfdf3;color:#067647;border-radius:8px}
        @media(max-width:820px){:root{--sidebar-width:100%}.sidebar{position:relative;width:100%;min-height:auto;padding:14px}.brand{padding-bottom:13px}.sidebar nav{display:flex;overflow-x:auto;gap:6px;padding:10px 0 2px}.menu-label,.nav-section-label{display:none}.nav-link{flex:0 0 auto;margin:0;padding:7px 10px;min-height:44px}.nav-link.active::before{display:none}.nav-icon{width:30px;height:30px}.profile{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-top:12px;padding:9px 11px}.logout-form{margin:0}.logout-button{width:auto;padding:0 14px}.main{margin:0;padding:18px}.action-group{justify-content:flex-start;flex-wrap:wrap}}
        @media(max-width:520px){.brand-copy strong{font-size:.87rem}.role-pill{display:none}.profile-caption{display:none}.nav-text{font-size:.78rem}.main{padding:12px}.nav-lock{display:none}}
        .journal-switcher{display:block;margin:0;min-width:280px}.journal-switcher__label{display:block;margin-bottom:6px;color:inherit;font-size:.68rem;font-weight:600;letter-spacing:.06em;text-transform:uppercase;opacity:.78}.journal-switcher__control{position:relative;display:block}.journal-switcher__control svg{position:absolute;z-index:1;left:12px;top:50%;width:17px;height:17px;transform:translateY(-50%);color:#2b6197;pointer-events:none}.journal-switcher select{width:100%;height:44px;margin:0;padding:0 38px;border:1px solid #cbd9e7;border-radius:10px;background:#fff;color:#213850;font-size:.78rem;font-weight:500;white-space:nowrap;text-overflow:ellipsis;box-shadow:0 5px 14px rgba(12,38,70,.08);cursor:pointer}.journal-switcher select:focus{outline:0;border-color:#4d8dcc;box-shadow:0 0 0 3px rgba(77,141,204,.16)}
    </style>
</head>
<body>
<?php
$currentPath = trim(uri_string(), '/');
$role = (string) session('role');
$userName = (string) session('name');
$initials = implode('', array_map(static fn (string $word): string => strtoupper(substr($word, 0, 1)), array_slice(preg_split('/\s+/', trim($userName)) ?: ['A'], 0, 2)));
$isRubricPage = str_contains($currentPath, '/rubrik');
$isCriteriaPage = (str_starts_with($currentPath, 'jurnal/evaluasi/') && ! $isRubricPage) || str_ends_with($currentPath, '/kriteria');
$isDataPage = str_starts_with($currentPath, 'jurnal/data') || (bool) preg_match('#^jurnal/\d+$#', $currentPath);
?>
<aside class="sidebar">
    <div class="brand">
        <span class="brand-mark" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 18.5V8.8c0-.7.4-1.3 1-1.6l6-3.1c.6-.3 1.3-.3 1.9 0l6 3.1c.7.3 1.1.9 1.1 1.6v9.7"/><path d="M2.5 19.5h19M8 10.5h8M8 14h8M8 17.5h5"/></svg></span>
        <span class="brand-copy"><strong>Simulasi Akreditasi<br>Jurnal</strong><span class="role-pill"><?= $role === 'super_admin' ? 'Operator Sistem' : 'Admin Jurnal' ?></span></span>
    </div>

    <p class="menu-label">Menu utama</p>
    <nav aria-label="Navigasi utama">
        <?php if ($role === 'super_admin'): ?>
            <a class="nav-link <?= $currentPath === 'admin' ? 'active' : '' ?>" href="<?= site_url('admin') ?>"><span class="nav-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg></span><span class="nav-text">Dashboard</span></a>
            <span class="nav-section-label">Sistem</span>
            <a class="nav-link <?= str_starts_with($currentPath, 'admin/admin-jurnal') ? 'active' : '' ?>" href="<?= site_url('admin/admin-jurnal') ?>"><span class="nav-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="9" cy="8" r="3"/><path d="M3.5 19a5.5 5.5 0 0 1 11 0M16 11h5M18.5 8.5v5"/></svg></span><span class="nav-text">Pengguna</span></a>
            <a class="nav-link <?= $currentPath === 'akun' ? 'active' : '' ?>" href="<?= site_url('akun') ?>"><span class="nav-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="8" r="4"/><path d="M4.5 21a7.5 7.5 0 0 1 15 0"/><path d="M18.5 4.5 20 3m-1.5 8L20 12"/></svg></span><span class="nav-text">Pengaturan Akun</span></a>
        <?php else: ?>
            <?php
            $db = db_connect();
            $journalBuilder = $db->table('journals')->select('journals.id')->join('journal_admins', 'journal_admins.journal_id = journals.id')->where('journal_admins.user_id', session('user_id'))->where('journals.is_active', 1);
            $activeJournalId = (int) session('active_journal_id');
            $assignedJournal = $activeJournalId > 0 ? (clone $journalBuilder)->where('journals.id', $activeJournalId)->get()->getRowArray() : null;
            $assignedJournal ??= $journalBuilder->orderBy('journals.name')->get()->getRowArray();
            $assignedEvaluation = $assignedJournal ? $db->table('evaluations')->where('journal_id', $assignedJournal['id'])->orderBy('id', 'DESC')->get()->getRowArray() : null;
            $criteriaPassed = $assignedEvaluation ? $db->table('eligibility_answers')->where('evaluation_id', $assignedEvaluation['id'])->where('status', 'sesuai')->countAllResults() === 17 : false;
            $criteriaUrl = $assignedEvaluation ? site_url('jurnal/evaluasi/' . $assignedEvaluation['id']) : ($assignedJournal ? site_url('jurnal/' . $assignedJournal['id'] . '/kriteria') : site_url('jurnal/data'));
            $rubricUrl = $criteriaPassed ? site_url('jurnal/evaluasi/' . $assignedEvaluation['id'] . '/rubrik') : $criteriaUrl;
            ?>
            <a class="nav-link <?= $currentPath === 'jurnal' ? 'active' : '' ?>" href="<?= site_url('jurnal') ?>"><span class="nav-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 11.5 12 4l9 7.5"/><path d="M5.5 10v10h13V10M9.5 20v-6h5v6"/></svg></span><span class="nav-text">Dashboard</span></a>
            <a class="nav-link <?= $isDataPage ? 'active' : '' ?>" href="<?= site_url('jurnal/data') ?>"><span class="nav-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 4h11a3 3 0 0 1 3 3v13H7a2 2 0 0 1-2-2V4Z"/><path d="M7 16h12M8 8h7M8 11h7"/></svg></span><span class="nav-text">Data Jurnal</span></a>
            <a class="nav-link <?= $isCriteriaPage ? 'active' : '' ?>" href="<?= $criteriaUrl ?>"><span class="nav-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 3h10v3h3v15H4V6h3V3Z"/><path d="m8 12 2 2 5-5M8 18h8"/></svg></span><span class="nav-text">Evaluasi Kriteria Jurnal</span></a>
            <a class="nav-link <?= $isRubricPage ? 'active' : '' ?> <?= $criteriaPassed ? '' : 'locked' ?>" href="<?= $rubricUrl ?>" <?= $criteriaPassed ? '' : 'title="Selesaikan Evaluasi Kriteria Jurnal terlebih dahulu"' ?>><span class="nav-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/></svg></span><span class="nav-text">Evaluasi Diri</span><?php if (! $criteriaPassed): ?><span class="nav-lock" aria-label="Terkunci"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="10" width="14" height="10" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg></span><?php endif ?></a>
            <a class="nav-link <?= $currentPath === 'jurnal/dokumentasi' ? 'active' : '' ?>" href="<?= site_url('jurnal/dokumentasi') ?>"><span class="nav-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H11v16H6.5A2.5 2.5 0 0 0 4 21.5v-16ZM20 5.5A2.5 2.5 0 0 0 17.5 3H13v16h4.5a2.5 2.5 0 0 1 2.5 2.5v-16Z"/></svg></span><span class="nav-text">Dokumentasi Akreditasi</span></a>
            <a class="nav-link <?= $currentPath === 'akun' ? 'active' : '' ?>" href="<?= site_url('akun') ?>"><span class="nav-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="8" r="4"/><path d="M4.5 21a7.5 7.5 0 0 1 15 0"/><path d="M18.5 4.5 20 3m-1.5 8L20 12"/></svg></span><span class="nav-text">Pengaturan Akun</span></a>
        <?php endif ?>
    </nav>

    <div class="profile">
        <div class="profile-row"><span class="avatar"><?= esc($initials ?: 'A') ?></span><span class="profile-copy"><span class="profile-name"><?= esc($userName) ?></span><span class="profile-caption">Akun aktif</span></span></div>
        <form class="logout-form" method="post" action="<?= site_url('logout') ?>"><?= csrf_field() ?><button class="logout-button" type="submit"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 4H4v16h6M15 8l4 4-4 4M8 12h11"/></svg>Keluar</button></form>
    </div>
</aside>
<main class="main"><?= $this->renderSection('content') ?></main>
</body>
</html>
