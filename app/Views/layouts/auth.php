<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Akun') ?> · Simulasi Akreditasi Jurnal</title>
    <link rel="icon" type="image/svg+xml" href="<?= base_url('favicon.svg') ?>?v=2">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root{font-family:'Inter',system-ui,sans-serif;color:#142b47;background:#eff5f8;--teal:#147d74;--navy:#153c69}*{box-sizing:border-box}body{min-height:100vh;margin:0;padding:34px 18px;display:flex;justify-content:center;background:radial-gradient(circle at 8% 15%,rgba(70,167,184,.12),transparent 30%),radial-gradient(circle at 90% 10%,rgba(238,174,110,.12),transparent 26%),linear-gradient(135deg,#f1f7f8,#f7f5f2)}button,input{font:inherit}.auth-shell{width:min(100%,720px)}.auth-brand{display:flex;align-items:center;justify-content:center;gap:15px;padding:20px 24px;border:1px solid #cfdae6;border-radius:17px;background:rgba(255,255,255,.92);box-shadow:0 9px 28px rgba(22,52,85,.07)}.brand-logo{width:56px;height:56px;display:grid;place-items:center;border-radius:16px;background:linear-gradient(145deg,#168b80,#0b675f);color:#fff;box-shadow:0 8px 18px rgba(14,111,102,.23)}.brand-logo svg{width:31px;height:31px}.brand-copy strong{display:block;font-size:1.35rem;font-weight:700;line-height:1.25}.brand-copy span{display:block;margin-top:4px;color:#647991;font-size:.86rem}.auth-card{margin-top:20px;padding:38px 46px 32px;border:1px solid #cfdae6;border-radius:18px;background:#fff;box-shadow:0 15px 40px rgba(22,52,85,.09)}.auth-intro{padding:27px 25px;text-align:center;border:1px solid #9fcfc9;border-radius:14px;background:linear-gradient(135deg,#f0f9f8,#fff9f3)}.auth-intro h1{margin:0;font-size:1.55rem;line-height:1.3}.auth-intro p{max-width:490px;margin:9px auto 0;color:#526980;font-size:.89rem;line-height:1.55}.auth-alert{margin-top:20px;padding:12px 14px;border-radius:10px;font-size:.8rem;line-height:1.5}.auth-alert.error{border:1px solid #f4c8c5;background:#fff1f0;color:#9e2d27}.auth-alert.success{border:1px solid #a9dfc3;background:#edfbf3;color:#11633e}.auth-form{margin-top:25px}.form-field{display:block;margin-top:18px}.form-field:first-of-type{margin-top:0}.field-label{display:block;margin-bottom:8px;color:#1c3149;font-size:.82rem;font-weight:600}.required{color:#c43c2d}.input-wrap{position:relative}.input-icon{position:absolute;left:15px;top:50%;width:19px;height:19px;transform:translateY(-50%);color:#61778e;pointer-events:none}.input-wrap input{display:block;width:100%;height:54px;margin:0;padding:0 48px 0 46px;border:1px solid #c9d5e3;border-radius:11px;background:#f3f7fc;color:#172b43;font-size:.9rem;transition:.16s}.input-wrap input::placeholder{color:#8b9aab}.input-wrap input:focus{outline:0;border-color:#4a9c94;background:#fff;box-shadow:0 0 0 3px rgba(40,145,135,.12)}.password-toggle{position:absolute;right:8px;top:50%;width:38px;height:38px;display:grid;place-items:center;transform:translateY(-50%);border:0;border-radius:8px;background:transparent;color:#61778e;cursor:pointer}.password-toggle:hover{background:#e5edf7;color:#244d78}.password-toggle svg{width:19px;height:19px}.submit-button{width:100%;height:52px;margin-top:25px;border:0;border-radius:10px;background:linear-gradient(135deg,#178278,#116e67);color:#fff;font-weight:600;cursor:pointer;box-shadow:0 10px 24px rgba(19,120,111,.2);transition:.16s}.submit-button:hover{transform:translateY(-1px);box-shadow:0 13px 28px rgba(19,120,111,.26)}.auth-divider{display:flex;align-items:center;gap:12px;margin:22px 0;color:#8493a3;font-size:.72rem}.auth-divider::before,.auth-divider::after{content:"";height:1px;flex:1;background:#dde4ec}.secondary-link{width:100%;height:48px;display:flex;align-items:center;justify-content:center;border:1px solid #b7c8d8;border-radius:10px;background:#fff;color:#1d537e;text-decoration:none;font-size:.84rem;font-weight:600;transition:.16s}.secondary-link:hover{border-color:#4d83ad;background:#f2f7fb}.auth-note{margin:18px 0 0;text-align:center;color:#75879a;font-size:.72rem;line-height:1.5}
        @media(max-width:620px){body{padding:16px 12px}.auth-brand{justify-content:flex-start;padding:16px 18px}.brand-logo{width:48px;height:48px}.brand-copy strong{font-size:1.05rem}.auth-card{margin-top:14px;padding:24px 18px}.auth-intro{padding:22px 15px}.auth-intro h1{font-size:1.3rem}.input-wrap input{height:51px}}
        /* Ukuran ringkas dan warna utama biru aplikasi. */
        body{padding:18px 14px;background:radial-gradient(circle at 8% 12%,rgba(56,119,182,.1),transparent 28%),radial-gradient(circle at 92% 8%,rgba(92,142,194,.08),transparent 24%),#f3f6fa}
        .auth-shell{width:min(100%,520px)}
        .auth-brand{gap:12px;padding:14px 18px;border-radius:14px}
        .brand-logo{width:44px;height:44px;border-radius:12px;background:linear-gradient(145deg,#2868a8,#173f75);box-shadow:0 7px 16px rgba(23,63,117,.2)}
        .brand-logo svg{width:25px;height:25px}.brand-copy strong{font-size:1.05rem}.brand-copy span{margin-top:2px;font-size:.72rem}
        .auth-card{margin-top:14px;padding:24px 30px 22px;border-radius:15px}
        .auth-intro{padding:18px 18px;border-color:#b7cee5;border-radius:11px;background:linear-gradient(135deg,#f1f6fc,#f9fbfd)}
        .auth-intro h1{font-size:1.28rem}.auth-intro p{margin-top:6px;font-size:.78rem;line-height:1.45}
        .auth-alert{margin-top:14px}.auth-form{margin-top:18px}.form-field{margin-top:13px}.field-label{margin-bottom:6px;font-size:.76rem}
        .input-wrap input{height:46px;padding-left:42px;border-radius:9px;font-size:.81rem}.input-icon{left:13px;width:17px;height:17px}
        .input-wrap input:focus{border-color:#3979b8;box-shadow:0 0 0 3px rgba(38,103,168,.12)}
        .password-toggle{width:35px;height:35px;color:#57718c}.password-toggle:hover{background:#e3edf8;color:#173f75}
        .submit-button{height:46px;margin-top:19px;border-radius:9px;background:linear-gradient(135deg,#245f9e,#173f75);box-shadow:0 8px 20px rgba(23,63,117,.2)}
        .submit-button:hover{box-shadow:0 11px 24px rgba(23,63,117,.25)}
        .auth-divider{margin:17px 0}.secondary-link{height:43px;border-color:#b7c9dc;color:#17477d}.auth-note{margin-top:13px;font-size:.64rem;white-space:nowrap}
        @media(max-width:620px){.auth-shell{width:min(100%,470px)}.auth-card{padding:21px 17px}.auth-brand{padding:12px 15px}.brand-copy span{font-size:.67rem}.auth-note{white-space:normal}}
    </style>
</head>
<body>
<main class="auth-shell">
    <header class="auth-brand">
        <span class="brand-logo" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M4 18.5V8.8c0-.7.4-1.3 1-1.6l6-3.1c.6-.3 1.3-.3 1.9 0l6 3.1c.7.3 1.1.9 1.1 1.6v9.7"/><path d="M2.5 19.5h19M8 10.5h8M8 14h8M8 17.5h5"/></svg></span>
        <span class="brand-copy"><strong>Simulasi Akreditasi Jurnal</strong><span>Instrumen Evaluasi dan Peningkatan Mutu Jurnal</span></span>
    </header>
    <section class="auth-card">
        <?= $this->renderSection('content') ?>
    </section>
</main>
<script>
document.querySelectorAll('[data-password-toggle]').forEach(function(button){
    button.addEventListener('click',function(){
        const input=document.getElementById(button.dataset.passwordToggle);
        const visible=input.type==='text';
        input.type=visible?'password':'text';
        button.setAttribute('aria-label',visible?'Tampilkan kata sandi':'Sembunyikan kata sandi');
        button.setAttribute('aria-pressed',String(!visible));
    });
});
</script>
</body>
</html>
