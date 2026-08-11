<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<style>
    .criteria-header{display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;margin-bottom:1.25rem}
    .criteria-header h1{margin:.25rem 0;font-size:2rem}.criteria-header p{margin:0}.criteria-header-actions{display:flex;align-items:end;gap:.75rem;min-width:min(100%,520px)}.criteria-header-actions .journal-switcher{width:100%;min-width:420px}
    .criteria-progress{display:grid;grid-template-columns:1fr 48px 1fr;align-items:center;margin-bottom:1.25rem}
    .progress-stage{display:flex;align-items:center;gap:.75rem;padding:1rem;border:1px solid #dbe3ef;border-radius:10px;background:#fff}
    .progress-stage.active{border-color:#3478c5;box-shadow:0 0 0 3px #3478c512}.progress-stage.passed{border-color:#86d5a5;background:#f1fcf5}
    .progress-number{display:grid;place-items:center;flex:0 0 34px;height:34px;border-radius:50%;background:#e2e8f0;color:#475569;font-weight:800}.active .progress-number{background:#173b6c;color:#fff}.passed .progress-number{background:#07883e;color:#fff}
    .progress-stage strong{display:block}.progress-stage small{display:block;margin-top:.2rem;color:#64748b}.progress-line{height:2px;background:#cbd5e1}.progress-line.passed{background:#22a45d}
    .criteria-tabs{display:flex;gap:.5rem;margin-bottom:1rem;border-bottom:1px solid #dbe3ef}
    .criteria-tab{display:inline-flex;align-items:center;gap:.4rem;padding:.8rem 1rem;color:#64748b;text-decoration:none;font-weight:700;border-bottom:3px solid transparent}
    .criteria-tab.active{color:#173b6c;border-color:#173b6c}.criteria-tab.locked{color:#94a3b8;cursor:not-allowed}
    .criteria-alert{margin-bottom:1rem;padding:.85rem 1rem;border-radius:8px;background:#fff8e8;color:#8a5a00}.criteria-alert.success{background:#ecfdf3;color:#067647}.criteria-alert.error{background:#fff1f1;color:#9b1c1c}
    .criteria-table-wrap{overflow-x:auto;border:1px solid #dbe3ef;border-radius:10px}
    .criteria-table{min-width:900px;margin:0}.criteria-table th{padding:.8rem .75rem;background:#f8fafc;color:#475569;font-size:.77rem;letter-spacing:.035em;text-transform:uppercase}.criteria-table td{padding:.9rem .75rem;vertical-align:top}.criteria-table tbody tr:last-child td{border-bottom:0}
    .criteria-number{text-align:center;color:#64748b;font-weight:750}.criteria-parameter{max-width:235px;color:#334155;font-weight:700;line-height:1.45}.criteria-label{min-width:245px;line-height:1.5}
    .criteria-guidance{min-width:310px;color:#3f5369;font-size:.9rem;line-height:1.65}
    .guidance-note{display:flex;align-items:flex-start;gap:.65rem;margin-bottom:1rem;padding:.8rem .9rem;border:1px solid #c9dff4;border-radius:9px;background:#f1f7fd;color:#315a81;font-size:.82rem;line-height:1.55}.guidance-note span:first-child{display:grid;place-items:center;flex:0 0 24px;height:24px;border-radius:50%;background:#dbeafe;color:#17477d;font-weight:800}
    .check-cell{text-align:center}.criteria-check{position:relative;display:inline-flex;align-items:center;justify-content:center;margin:0;cursor:pointer}.criteria-check input{position:absolute;opacity:0;width:1px;height:1px}.criteria-check span{display:grid;place-items:center;width:30px;height:30px;border:2px solid #b8c5d6;border-radius:7px;background:#fff;color:transparent;font-size:1.1rem;transition:.15s}.criteria-check input:checked+span{border-color:#07883e;background:#07883e;color:#fff}.criteria-check input:focus+span{box-shadow:0 0 0 3px #3478c530}
    .criteria-footer{display:flex;align-items:center;justify-content:space-between;gap:1rem;margin-top:1.25rem}.criteria-summary{color:#64748b}.criteria-summary strong{color:#172033}
    .criteria-submit{min-width:170px;min-height:42px;font-weight:750}
    .unlock-card{padding:1rem;border:1px solid #86d5a5;border-radius:10px;background:#f1fcf5;color:#067647}
    @media(max-width:760px){.criteria-header{flex-direction:column}.criteria-progress{grid-template-columns:1fr}.progress-line{width:2px;height:22px;margin:auto}.criteria-tabs{overflow-x:auto}.criteria-footer{align-items:stretch;flex-direction:column}.criteria-submit{width:100%}}
@media(max-width:760px){.criteria-header-actions{width:100%;align-items:stretch;flex-direction:column}.criteria-header-actions .journal-switcher{min-width:0}}
</style>

<section class="card">
    <header class="criteria-header">
        <div><p class="muted">Pemeriksaan pemenuhan kriteria minimum</p><h1>Evaluasi Kriteria Jurnal</h1><p><?= esc($journal['name']) ?></p></div>
        <div class="criteria-header-actions"><?= view('components/journal_switcher', ['journalSwitcher' => $journalSwitcher, 'mode' => 'criteria']) ?></div>
    </header>

    <div class="criteria-progress">
        <div class="progress-stage <?= $initialPassed ? 'passed' : 'active' ?>"><span class="progress-number"><?= $initialPassed ? '✓' : '1' ?></span><div><strong>Pemeriksaan Awal</strong><small><?= $initialCompleted ?>/15 butir terpenuhi</small></div></div>
        <div class="progress-line <?= $initialPassed ? 'passed' : '' ?>"></div>
        <div class="progress-stage <?= $feasibilityPassed ? 'passed' : ($initialPassed ? 'active' : '') ?>"><span class="progress-number"><?= $feasibilityPassed ? '✓' : '2' ?></span><div><strong>Pemeriksaan Kelayakan</strong><small><?= $initialPassed ? $feasibilityCompleted . '/2 butir terpenuhi' : 'Terkunci' ?></small></div></div>
    </div>

    <?php if (session('success')): ?><div class="criteria-alert success" role="status"><?= esc(session('success')) ?></div><?php endif ?>
    <?php if (session('error')): ?><div class="criteria-alert error" role="alert"><?= esc(session('error')) ?></div><?php endif ?>

    <nav class="criteria-tabs" aria-label="Tahap evaluasi kriteria">
        <a class="criteria-tab <?= $activeSection === 'awal' ? 'active' : '' ?>" href="<?= site_url('jurnal/evaluasi/' . $evaluation['id']) ?>">1. Pemeriksaan Awal</a>
        <?php if ($initialPassed): ?><a class="criteria-tab <?= $activeSection === 'kelayakan' ? 'active' : '' ?>" href="<?= site_url('jurnal/evaluasi/' . $evaluation['id'] . '?section=kelayakan') ?>">2. Pemeriksaan Kelayakan</a><?php else: ?><span class="criteria-tab locked" title="Lengkapi Pemeriksaan Awal terlebih dahulu">🔒 2. Pemeriksaan Kelayakan</span><?php endif ?>
    </nav>

    <?php $displayItems = $activeSection === 'awal' ? $initialItems : $feasibilityItems; ?>
    <div class="guidance-note"><span aria-hidden="true">i</span><span>Baca panduan pada setiap baris, periksa kondisi jurnal, kemudian tandai <strong>Terpenuhi</strong> hanya jika seluruh hal yang disebutkan sudah sesuai dan dapat diverifikasi.</span></div>
    <form method="post" action="<?= site_url('jurnal/evaluasi/' . $evaluation['id']) ?>">
        <?= csrf_field() ?>
        <input type="hidden" name="section" value="<?= esc($activeSection) ?>">
        <div class="criteria-table-wrap">
            <table class="criteria-table">
                <thead><tr><th style="width:55px;text-align:center">No.</th><th>Parameter</th><th>Unsur Pemeriksaan</th><th>Panduan</th><th style="width:100px;text-align:center">Terpenuhi</th></tr></thead>
                <tbody>
                <?php foreach ($displayItems as $index => $item): $answer = $item['answer']; ?>
                    <tr>
                        <td class="criteria-number"><?= $index + 1 ?></td>
                        <td class="criteria-parameter"><?= esc($item['parameter'] ?? '-') ?></td>
                        <td class="criteria-label"><?= esc($item['label']) ?></td>
                        <td class="criteria-guidance"><?= esc($item['guidance']) ?></td>
                        <td class="check-cell"><label class="criteria-check" title="Tandai jika unsur telah terpenuhi"><input type="checkbox" name="fulfilled[<?= $item['id'] ?>]" value="1" <?= $answer['status'] === 'sesuai' ? 'checked' : '' ?>><span aria-hidden="true">✓</span></label></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <footer class="criteria-footer">
            <div class="criteria-summary"><strong><?= $activeSection === 'awal' ? $initialCompleted . '/15' : $feasibilityCompleted . '/2' ?></strong> butir telah terpenuhi. Semua checklist wajib terpenuhi untuk lulus.</div>
            <button class="criteria-submit" type="submit">Simpan Checklist</button>
        </footer>
    </form>

    <?php if ($feasibilityPassed): ?><div class="unlock-card" style="margin-top:1rem"><strong>Evaluasi Kriteria Jurnal selesai.</strong><br>Jurnal telah lulus Pemeriksaan Awal dan Pemeriksaan Kelayakan. Tahap Evaluasi Tata Kelola dan Mutu telah terbuka.</div><?php endif ?>
</section>

<?= $this->endSection() ?>
