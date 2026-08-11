<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<section class="card">
    <h1><?= esc($title) ?></h1>
    <?php if (session('error')): ?><p class="muted"><?= esc(session('error')) ?></p><?php endif ?>
    <p class="muted">Fondasi aplikasi telah siap. Modul jurnal dan evaluasi akan tersedia pada tahap berikutnya.</p>
</section>
<?= $this->endSection() ?>
