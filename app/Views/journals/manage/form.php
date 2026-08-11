<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<style>
    .journal-form-toolbar{display:flex;align-items:center;justify-content:space-between;gap:1rem;margin-bottom:1rem}
    .journal-form-back{display:inline-flex;align-items:center;gap:.35rem;color:#475569;text-decoration:none;font-weight:650}
    .journal-form-back:hover{color:#173b6c}
    .journal-form-header{margin-bottom:1.75rem;padding-bottom:1.25rem;border-bottom:1px solid #e2e8f0}
    .journal-form-header p{margin:0;color:#64748b}.journal-form-header h1{margin:.3rem 0 0;font-size:2rem}
    .form-section{margin-top:1.5rem}.form-section:first-of-type{margin-top:0}
    .form-section-title{margin:0 0 1rem;font-size:1.08rem;color:#173b6c}
    .form-fields{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:1rem 1.25rem}
    .form-field{margin:0}.form-field.full{grid-column:1/-1}.form-field label{margin:0 0 .4rem;color:#334155;font-size:.9rem}
    .form-field input,.form-field textarea{min-height:44px;margin:0;padding:.7rem .8rem;background:#fff;border-color:#cbd5e1;transition:border-color .15s,box-shadow .15s}
    .form-field textarea{min-height:145px;line-height:1.55;resize:vertical}
    .form-field input:focus,.form-field textarea:focus{outline:0;border-color:#3478c5;box-shadow:0 0 0 3px #3478c520}
    .required{color:#b42318}.field-help{display:block;margin-top:.35rem;color:#64748b;font-size:.78rem}
    .form-errors{margin-bottom:1.25rem;padding:.85rem 1rem;border-left:4px solid #b42318;background:#fff1f1;color:#8f1d18;border-radius:6px}
    .form-actions{display:flex;align-items:center;justify-content:flex-end;gap:.6rem;margin-top:1.75rem;padding-top:1.25rem;border-top:1px solid #e2e8f0}
    .form-actions .button,.form-actions button{display:inline-flex;align-items:center;justify-content:center;min-width:110px;min-height:42px;margin:0;font-weight:700}
    .form-actions .cancel{background:#fff;color:#475569;border:1px solid #cbd5e1}
    @media(max-width:760px){.form-fields{grid-template-columns:1fr}.form-field.full{grid-column:auto}.journal-form-toolbar{align-items:flex-start;flex-direction:column}.form-actions{display:grid;grid-template-columns:1fr 1fr}.form-actions .button,.form-actions button{width:100%}}
</style>

<div class="journal-form-toolbar"><a class="journal-form-back" href="<?= site_url('jurnal/data') ?>"><span aria-hidden="true">←</span> Data Jurnal</a></div>

<section class="card">
    <header class="journal-form-header"><p><?= $journal ? 'Perbarui identitas dan informasi jurnal' : 'Lengkapi identitas jurnal baru' ?></p><h1><?= esc($title) ?></h1></header>

    <?php if (session('errors')): ?><div class="form-errors" role="alert"><strong>Data belum dapat disimpan.</strong><br><?= esc(implode(' ', session('errors'))) ?></div><?php endif ?>

    <form method="post" action="<?= $journal ? site_url('jurnal/data/' . $journal['id']) : site_url('jurnal/data') ?>">
        <?= csrf_field() ?>
        <section class="form-section">
            <h2 class="form-section-title">Identitas Jurnal</h2>
            <div class="form-fields">
                <div class="form-field full"><label for="name">Nama Jurnal <span class="required">*</span></label><input id="name" name="name" required maxlength="191" value="<?= esc(old('name', $journal['name'] ?? '')) ?>" placeholder="Contoh: Jurnal Pengabdian Kepada Masyarakat"></div>
                <div class="form-field"><label for="e_issn">e-ISSN</label><input id="e_issn" name="e_issn" maxlength="20" value="<?= esc(old('e_issn', $journal['e_issn'] ?? '')) ?>" placeholder="Contoh: 2987-9175"></div>
                <div class="form-field"><label for="doi_prefix">Prefix DOI</label><input id="doi_prefix" name="doi_prefix" maxlength="100" value="<?= esc(old('doi_prefix', $journal['doi_prefix'] ?? '')) ?>" placeholder="Contoh: 10.59632"></div>
                <div class="form-field full"><label for="website_url">URL Jurnal</label><input id="website_url" type="url" name="website_url" maxlength="255" value="<?= esc(old('website_url', $journal['website_url'] ?? '')) ?>" placeholder="https://contoh.ac.id/index.php/jurnal"><small class="field-help">Gunakan alamat lengkap yang dapat diakses publik.</small></div>
            </div>
        </section>

        <section class="form-section">
            <h2 class="form-section-title">Penerbitan</h2>
            <div class="form-fields">
                <div class="form-field full"><label for="publisher">Penerbit</label><input id="publisher" name="publisher" maxlength="191" value="<?= esc(old('publisher', $journal['publisher'] ?? '')) ?>" placeholder="Nama institusi atau organisasi penerbit"></div>
                <div class="form-field"><label for="frequency">Frekuensi Terbit</label><input id="frequency" name="frequency" maxlength="80" value="<?= esc(old('frequency', $journal['frequency'] ?? '')) ?>" placeholder="Contoh: Juni dan Desember"></div>
                <div class="form-field"><label for="first_published_year">Tahun Terbit Awal</label><input id="first_published_year" type="number" min="1901" max="2100" name="first_published_year" value="<?= esc(old('first_published_year', $journal['first_published_year'] ?? '')) ?>" placeholder="2023"></div>
            </div>
        </section>

        <section class="form-section">
            <h2 class="form-section-title">Cakupan Jurnal</h2>
            <div class="form-field"><label for="scope">Fokus dan Ruang Lingkup</label><textarea id="scope" name="scope" placeholder="Jelaskan fokus bidang dan ruang lingkup artikel yang diterbitkan."><?= esc(old('scope', $journal['scope'] ?? '')) ?></textarea></div>
        </section>

        <footer class="form-actions"><a class="button cancel" href="<?= site_url('jurnal/data') ?>">Batal</a><button type="submit">Simpan Jurnal</button></footer>
    </form>
</section>

<?= $this->endSection() ?>
