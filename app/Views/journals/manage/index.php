<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<style>
    .journal-page-header{display:flex;align-items:center;justify-content:space-between;gap:1.5rem;margin-bottom:1.5rem}
    .journal-page-header h1{margin:.2rem 0 0;font-size:2rem;line-height:1.2}
    .journal-page-header p{margin:0}
    .journal-add-button{display:inline-flex;align-items:center;justify-content:center;gap:.45rem;min-height:42px;padding:.65rem 1rem;white-space:nowrap;font-weight:700}
    .journal-table-wrap{width:100%;overflow-x:auto;border:1px solid #e2e8f0;border-radius:10px}
    .journal-table{margin:0;min-width:920px}
    .journal-table th{padding:.85rem 1rem;background:#f8fafc;color:#475569;font-size:.78rem;letter-spacing:.04em;text-transform:uppercase;white-space:nowrap}
    .journal-table td{padding:1rem;vertical-align:middle}
    .journal-table tbody tr:last-child td{border-bottom:0}
    .journal-table tbody tr:hover{background:#f8fbff}
    .journal-name{display:block;color:#172033;font-size:.98rem;line-height:1.4}
    .journal-url{display:block;max-width:350px;margin-top:.25rem;color:#64748b;font-size:.82rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;text-decoration:none}
    .journal-url:hover{color:#173b6c;text-decoration:underline}
    .journal-meta{line-height:1.55}
    .journal-meta small{display:block;color:#64748b}
    .journal-badge{display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .6rem;border-radius:999px;background:#ecfdf3;color:#067647;font-size:.78rem;font-weight:700;white-space:nowrap}
    .journal-badge.inactive{background:#f1f5f9;color:#64748b}
    .journal-actions{display:grid;grid-template-columns:repeat(3,72px);align-items:center;justify-content:end;gap:.4rem}
    .journal-actions form{display:block;margin:0}
    .journal-actions .button,.journal-actions button{display:inline-flex;align-items:center;justify-content:center;width:72px;height:38px;margin:0;padding:0;border:0;border-radius:7px;font:inherit;font-size:.84rem;font-weight:650;line-height:1;text-decoration:none;cursor:pointer}
    .journal-actions .detail{background:#173b6c;color:#fff}
    .journal-actions .edit{background:#eaf2ff;color:#173b6c}
    .journal-actions .delete{background:#fff0f0;color:#b42318}
    .journal-actions .detail:hover{background:#102f59}.journal-actions .edit:hover{background:#dbeafe}.journal-actions .delete:hover{background:#fee2e2}
    .journal-empty{padding:3rem 1rem!important;text-align:center;color:#64748b}
    .journal-count{margin-top:1rem;color:#64748b;font-size:.85rem}
    @media(max-width:760px){.journal-page-header{align-items:flex-start;flex-direction:column}.journal-add-button{width:100%}.journal-table-wrap{border:0;overflow:visible}.journal-table{min-width:0}.journal-table thead{display:none}.journal-table,.journal-table tbody,.journal-table tr,.journal-table td{display:block;width:100%}.journal-table tr{margin-bottom:1rem;padding:1rem;background:#fff;border:1px solid #e2e8f0;border-radius:10px}.journal-table td{display:grid;grid-template-columns:110px 1fr;gap:.75rem;padding:.55rem 0;border:0}.journal-table td::before{content:attr(data-label);color:#64748b;font-size:.78rem;font-weight:700;text-transform:uppercase}.journal-actions{justify-content:start;grid-template-columns:repeat(3,72px)}.journal-table td:last-child{display:block;padding-top:1rem}.journal-table td:last-child::before{display:none}}
</style>

<section class="card">
    <header class="journal-page-header">
        <div><p class="muted">Kelola identitas dan profil jurnal</p><h1>Data Jurnal</h1></div>
        <a class="button journal-add-button" href="<?= site_url('jurnal/data/tambah') ?>"><span aria-hidden="true">+</span> Tambah Jurnal</a>
    </header>

    <?php if (session('success')): ?><p class="flash" role="status"><?= esc(session('success')) ?></p><?php endif ?>

    <div class="journal-table-wrap">
        <table class="journal-table">
            <thead><tr><th style="width:48px">No.</th><th>Jurnal</th><th style="width:145px">Identitas</th><th>Penerbit</th><th style="width:95px">Status</th><th style="width:240px;text-align:right">Aksi</th></tr></thead>
            <tbody>
            <?php foreach ($journals as $index => $journal): ?>
                <tr>
                    <td data-label="No."><?= $index + 1 ?></td>
                    <td data-label="Jurnal"><strong class="journal-name"><?= esc($journal['name']) ?></strong><?php if ($journal['website_url']): ?><a class="journal-url" href="<?= esc($journal['website_url']) ?>" target="_blank" rel="noopener" title="<?= esc($journal['website_url']) ?>"><?= esc($journal['website_url']) ?></a><?php else: ?><small class="muted">URL belum diisi</small><?php endif ?></td>
                    <td data-label="Identitas"><div class="journal-meta"><strong><?= esc($journal['e_issn'] ?? '-') ?></strong><small>DOI: <?= esc($journal['doi_prefix'] ?? '-') ?></small></div></td>
                    <td data-label="Penerbit"><?= esc($journal['publisher'] ?? '-') ?></td>
                    <td data-label="Status"><span class="journal-badge <?= $journal['is_active'] ? '' : 'inactive' ?>"><span aria-hidden="true">●</span><?= $journal['is_active'] ? 'Aktif' : 'Nonaktif' ?></span></td>
                    <td data-label="Aksi"><div class="journal-actions"><a class="button detail" href="<?= site_url('jurnal/' . $journal['id']) ?>">Detail</a><a class="button edit" href="<?= site_url('jurnal/data/' . $journal['id'] . '/ubah') ?>">Edit</a><form method="post" action="<?= site_url('jurnal/data/' . $journal['id'] . '/hapus') ?>" onsubmit="return confirm('Hapus jurnal ini beserta seluruh evaluasinya? Tindakan ini tidak dapat dibatalkan.')"><?= csrf_field() ?><button class="delete" type="submit">Hapus</button></form></div></td>
                </tr>
            <?php endforeach ?>
            <?php if ($journals === []): ?><tr><td colspan="6" class="journal-empty"><strong>Belum ada jurnal</strong><br>Gunakan tombol Tambah Jurnal untuk membuat data pertama.</td></tr><?php endif ?>
            </tbody>
        </table>
    </div>
    <?php if ($journals !== []): ?><p class="journal-count">Menampilkan <?= count($journals) ?> jurnal.</p><?php endif ?>
</section>

<?= $this->endSection() ?>
