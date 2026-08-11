<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<style>
    .detail-toolbar{display:flex;align-items:center;justify-content:space-between;gap:1rem;margin-bottom:1rem}
    .detail-back{display:inline-flex;align-items:center;gap:.35rem;color:#475569;text-decoration:none;font-weight:650}
    .detail-back:hover{color:#173b6c}
    .detail-actions{display:flex;align-items:center;gap:.5rem}
    .detail-actions .button{display:inline-flex;align-items:center;justify-content:center;min-width:105px;min-height:40px;font-weight:700}
    .detail-actions .secondary{background:#fff;color:#173b6c;border:1px solid #cbd5e1}
    .detail-hero{padding:1.6rem 1.8rem;border-radius:14px;background:linear-gradient(120deg,#173b6c,#316baa);color:#fff;box-shadow:0 8px 24px #173b6c24}
    .detail-kicker{margin:0 0 .4rem;color:#dbeafe;font-size:.85rem;font-weight:700;letter-spacing:.05em;text-transform:uppercase}
    .detail-hero h1{max-width:1000px;margin:0;font-size:clamp(1.55rem,3vw,2.25rem);line-height:1.25}
    .detail-identity{display:flex;align-items:center;gap:.65rem;margin-top:.9rem}
    .detail-badge{display:inline-flex;align-items:center;padding:.3rem .65rem;border-radius:999px;background:#ffffff20;border:1px solid #ffffff45;font-size:.85rem;font-weight:700}
    .detail-grid{display:grid;grid-template-columns:minmax(0,1fr) minmax(0,1fr);gap:1rem;margin-top:1rem}
    .detail-card{padding:1.5rem}
    .detail-card h2{margin:0 0 1rem;font-size:1.2rem}
    .detail-list{margin:0}
    .detail-row{display:grid;grid-template-columns:155px minmax(0,1fr);gap:1rem;padding:.85rem 0;border-bottom:1px solid #e2e8f0}
    .detail-row:first-child{padding-top:.25rem}.detail-row:last-child{padding-bottom:.25rem;border-bottom:0}
    .detail-row dt{color:#64748b;font-size:.86rem;font-weight:700}.detail-row dd{margin:0;color:#172033;line-height:1.55;overflow-wrap:anywhere}
    .detail-link{color:#175ea8;font-weight:650;text-decoration:none}.detail-link:hover{text-decoration:underline}
    .scope-text{white-space:pre-line}
    @media(max-width:760px){.detail-toolbar{align-items:stretch;flex-direction:column}.detail-actions{display:grid;grid-template-columns:1fr 1fr}.detail-actions .button{width:100%}.detail-grid{grid-template-columns:1fr}.detail-row{grid-template-columns:1fr;gap:.25rem}.detail-hero{padding:1.25rem}}
</style>

<div class="detail-toolbar">
    <a class="detail-back" href="<?= site_url('jurnal/data') ?>"><span aria-hidden="true">←</span> Data Jurnal</a>
    <div class="detail-actions"><a class="button secondary" href="<?= site_url('jurnal/data') ?>">Kembali</a><a class="button" href="<?= site_url('jurnal/data/' . $journal['id'] . '/ubah') ?>">Edit Jurnal</a></div>
</div>

<header class="detail-hero">
    <p class="detail-kicker">Detail Jurnal</p>
    <h1><?= esc($journal['name']) ?></h1>
    <div class="detail-identity"><span class="detail-badge">e-ISSN <?= esc($journal['e_issn'] ?? 'Belum diisi') ?></span><?php if ($journal['is_active']): ?><span class="detail-badge">Aktif</span><?php endif ?></div>
</header>

<div class="detail-grid">
    <section class="card detail-card">
        <h2>Identitas dan Penerbitan</h2>
        <dl class="detail-list">
            <div class="detail-row"><dt>Nama jurnal</dt><dd><?= esc($journal['name']) ?></dd></div>
            <div class="detail-row"><dt>e-ISSN</dt><dd><?= esc($journal['e_issn'] ?? '-') ?></dd></div>
            <div class="detail-row"><dt>Penerbit</dt><dd><?= esc($journal['publisher'] ?? '-') ?></dd></div>
            <div class="detail-row"><dt>Frekuensi terbit</dt><dd><?= esc($journal['frequency'] ?? '-') ?></dd></div>
            <div class="detail-row"><dt>Tahun terbit awal</dt><dd><?= esc($journal['first_published_year'] ?? '-') ?></dd></div>
            <div class="detail-row"><dt>Prefix DOI</dt><dd><?= esc($journal['doi_prefix'] ?? '-') ?></dd></div>
        </dl>
    </section>
    <section class="card detail-card">
        <h2>Informasi dan Cakupan</h2>
        <dl class="detail-list">
            <div class="detail-row"><dt>URL jurnal</dt><dd><?php if ($journal['website_url']): ?><a class="detail-link" href="<?= esc($journal['website_url']) ?>" target="_blank" rel="noopener"><?= esc($journal['website_url']) ?> ↗</a><?php else: ?>-<?php endif ?></dd></div>
            <div class="detail-row"><dt>Fokus dan ruang lingkup</dt><dd class="scope-text"><?= esc($journal['scope'] ?? '-') ?></dd></div>
        </dl>
    </section>
</div>

<?= $this->endSection() ?>
