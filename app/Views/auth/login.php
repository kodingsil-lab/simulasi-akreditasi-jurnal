<?= $this->extend('layouts/auth') ?>
<?= $this->section('content') ?>
<div class="auth-intro"><h1>Masuk ke akun Anda</h1><p>Masukkan email dan kata sandi untuk melanjutkan ke dashboard simulasi akreditasi jurnal.</p></div>
<?php if (session('error')): ?><div class="auth-alert error" role="alert"><?= esc(session('error')) ?></div><?php endif ?>
<?php if (session('success')): ?><div class="auth-alert success" role="status"><?= esc(session('success')) ?></div><?php endif ?>
<?php if (session('errors')): ?><div class="auth-alert error" role="alert"><?= esc(implode(' ', session('errors'))) ?></div><?php endif ?>
<form class="auth-form" method="post" action="<?= site_url('login') ?>">
    <?= csrf_field() ?>
    <label class="form-field"><span class="field-label">Email <span class="required">*</span></span><span class="input-wrap"><svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m4 7 8 6 8-6"/></svg><input type="email" name="email" value="<?= esc(old('email')) ?>" placeholder="nama@email.com" autocomplete="email" required autofocus></span></label>
    <label class="form-field"><span class="field-label">Kata sandi <span class="required">*</span></span><span class="input-wrap"><svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="5" y="10" width="14" height="10" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg><input id="login-password" type="password" name="password" placeholder="Masukkan kata sandi" autocomplete="current-password" required><button class="password-toggle" type="button" data-password-toggle="login-password" aria-label="Tampilkan kata sandi" aria-pressed="false"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/><circle cx="12" cy="12" r="2.5"/></svg></button></span></label>
    <button class="submit-button" type="submit">Masuk</button>
</form>
<div class="auth-divider">atau</div>
<a class="secondary-link" href="<?= site_url('register') ?>">Daftar akun baru</a>
<p class="auth-note">Belum memiliki akun? Registrasi hanya memerlukan username, email, dan kata sandi.</p>
<?= $this->endSection() ?>
