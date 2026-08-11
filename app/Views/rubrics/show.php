<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<?php
$activeProgress = $categoryProgress[$activeCategory];
$activeItems = array_values(array_filter($items, static fn (array $item): bool => $item['category'] === $activeCategory));
$categoryCodes = array_keys($categories);
$activePosition = array_search($activeCategory, $categoryCodes, true);
$previousCategory = $categoryCodes[$activePosition - 1] ?? null;
$progressPercent = $totalItems > 0 ? round(($completedCount / $totalItems) * 100) : 0;
$formatScore = static function ($score): string {
    $value = number_format((float) $score, 1, ',', '.');
    return str_ends_with($value, ',0') ? substr($value, 0, -2) : $value;
};
?>

<style>
.self-evaluation{max-width:1500px;margin:0 auto;color:#13233b}.eval-hero{background:linear-gradient(135deg,#173f75,#2866a7);border-radius:18px;padding:28px 30px;color:#fff;box-shadow:0 12px 30px rgba(23,63,117,.16);margin-bottom:22px}.eval-hero__top{display:flex;align-items:flex-start;justify-content:space-between;gap:24px}.eval-eyebrow{margin:0 0 7px;font-size:.82rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase;color:#cfe4ff}.eval-hero h1{font-size:clamp(1.65rem,3vw,2.35rem);line-height:1.15;margin:0 0 8px}.eval-hero p{margin:0;color:#e8f2ff}.eval-year{min-width:118px;padding:12px 16px;border:1px solid rgba(255,255,255,.25);border-radius:12px;background:rgba(255,255,255,.1);text-align:center}.eval-year small{display:block;color:#d8eaff}.eval-year strong{font-size:1.25rem}.progress-panel{margin-top:24px;display:grid;grid-template-columns:minmax(0,1fr) auto;gap:16px;align-items:end}.progress-copy{display:flex;justify-content:space-between;gap:12px;margin-bottom:8px;font-size:.9rem;font-weight:700}.progress-track{height:10px;background:rgba(255,255,255,.2);border-radius:999px;overflow:hidden}.progress-track span{display:block;height:100%;border-radius:inherit;background:#63d7a2}.temporary-score{padding-left:20px;border-left:1px solid rgba(255,255,255,.24);text-align:right}.temporary-score small{display:block;color:#d8eaff}.temporary-score strong{font-size:1.45rem}.eval-layout{display:grid;grid-template-columns:300px minmax(0,1fr);gap:22px;align-items:start}.category-nav,.eval-main,.final-summary{background:#fff;border:1px solid #e4eaf1;border-radius:16px;box-shadow:0 8px 24px rgba(20,43,74,.07)}.category-nav{padding:18px;position:sticky;top:20px}.category-nav__title{margin:2px 4px 15px;font-size:.8rem;text-transform:uppercase;letter-spacing:.08em;color:#62748a}.category-link{display:grid;grid-template-columns:40px 1fr auto;gap:11px;align-items:center;padding:12px 10px;border-radius:12px;color:#253951;text-decoration:none;margin-bottom:5px;border:1px solid transparent}.category-link:hover{background:#f4f8fd}.category-link.active{background:#eaf3ff;border-color:#bed7f5;color:#173f75}.category-code{width:38px;height:38px;display:grid;place-items:center;border-radius:10px;background:#edf1f5;font-weight:900}.category-link.active .category-code{background:#1d4b82;color:#fff}.category-name{font-size:.83rem;font-weight:750;line-height:1.25}.category-meta{display:block;margin-top:4px;font-size:.75rem;font-weight:500;color:#718198}.category-status{width:24px;height:24px;display:grid;place-items:center;border-radius:50%;font-size:.72rem;background:#eef1f5;color:#68788c}.category-status.done{background:#dff7eb;color:#147448}.eval-main{overflow:hidden}.section-heading{padding:25px 28px;border-bottom:1px solid #e7edf3;background:#fbfdff}.section-heading__line{display:flex;justify-content:space-between;gap:20px;align-items:flex-start}.section-kicker{margin:0 0 6px;color:#27629f;font-size:.8rem;font-weight:850;text-transform:uppercase;letter-spacing:.07em}.section-heading h2{margin:0;font-size:1.55rem;line-height:1.25}.section-heading p{margin:8px 0 0;color:#65768a}.section-score{text-align:right;white-space:nowrap;background:#edf5ff;border-radius:12px;padding:10px 14px}.section-score small{display:block;color:#61748b}.section-score strong{font-size:1.18rem;color:#173f75}.eval-form{padding:24px 28px 28px}.rubric-card{border:1px solid #dfe6ee;border-radius:15px;padding:22px;margin-bottom:20px;background:#fff}.rubric-card__head{display:flex;justify-content:space-between;gap:18px;align-items:flex-start;margin-bottom:17px}.rubric-code{display:inline-block;color:#1d5b98;font-weight:900;margin-bottom:5px}.rubric-card h3{margin:0;font-size:1.12rem;line-height:1.35}.max-badge{white-space:nowrap;background:#f0f4f8;color:#42556d;border-radius:999px;padding:7px 11px;font-size:.78rem;font-weight:800}.option-list{display:grid;gap:10px}.score-option{position:relative}.score-option input{position:absolute;opacity:0;pointer-events:none}.score-option label{display:grid;grid-template-columns:82px 1fr;gap:14px;align-items:start;padding:15px;border:1.5px solid #dce4ed;border-radius:12px;cursor:pointer;transition:.16s;background:#fff}.score-option label:hover{border-color:#8db5df;background:#f9fcff}.score-option input:checked+label{border-color:#2766a5;background:#edf6ff;box-shadow:0 0 0 2px rgba(39,102,165,.09)}.score-badge{display:inline-flex;justify-content:center;border-radius:8px;padding:7px 9px;background:#e9eef4;color:#2a3d54;font-size:.82rem;font-weight:900}.score-option input:checked+label .score-badge{background:#1e568f;color:#fff}.indicator-copy{line-height:1.55;color:#34465b}.form-actions{display:flex;justify-content:space-between;gap:12px;align-items:center;padding-top:4px}.action-group{display:flex;gap:10px;align-items:center}.btn-eval{display:inline-flex;align-items:center;justify-content:center;min-height:44px;padding:0 18px;border-radius:9px;border:1px solid transparent;text-decoration:none;font-weight:800;font-size:.9rem;cursor:pointer}.btn-secondary{background:#fff;border-color:#cbd6e2;color:#28425f}.btn-primary{background:#17477d;color:#fff}.btn-primary:hover{background:#123a67}.eval-notice{border-radius:10px;padding:12px 15px;margin-bottom:18px;font-weight:700}.eval-notice.success{background:#e5f8ee;color:#176844}.eval-notice.error{background:#fff0ef;color:#a52b24}.final-summary{margin-top:22px;padding:25px 28px}.final-summary.locked{display:flex;align-items:center;gap:16px;background:#f8fafc}.lock-icon{width:48px;height:48px;flex:none;display:grid;place-items:center;border-radius:13px;background:#e9eef4;font-size:1.35rem}.final-summary h2{margin:0 0 6px}.final-summary p{margin:0;color:#62748a}.final-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-top:18px}.result-box{padding:16px;border-radius:12px;background:#f4f8fc}.result-box small{display:block;color:#667a91;margin-bottom:5px}.result-box strong{font-size:1.18rem}.result-box.highlight{background:#e7f5ee;color:#12643e}.disclaimer{margin-top:16px!important;font-size:.84rem}.required-note{font-size:.82rem;color:#6a7d92}.required-note b{color:#b42318}
@media(max-width:1050px){.eval-layout{grid-template-columns:1fr}.category-nav{position:static;display:flex;overflow-x:auto;gap:7px}.category-nav__title{display:none}.category-link{min-width:185px;margin:0}.final-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:700px){.eval-hero,.section-heading,.eval-form,.final-summary{padding:20px}.eval-hero__top,.progress-panel,.section-heading__line,.rubric-card__head{display:block}.temporary-score{border:0;padding:12px 0 0;text-align:left}.section-score{margin-top:14px;text-align:left}.score-option label{grid-template-columns:1fr}.score-badge{justify-self:start}.final-grid{grid-template-columns:1fr}.form-actions{align-items:stretch;flex-direction:column}.action-group{display:grid;grid-template-columns:1fr 1fr}.btn-primary{width:100%}}
/* Status pilihan aktif: hijau agar berbeda jelas dari navigasi biru. */
.score-option input:checked+label{
    border-color:#22a06b;
    background:#ecfdf3;
    box-shadow:0 0 0 2px rgba(34,160,107,.12);
}
.score-option input:checked+label .score-badge{
    background:#16855a;
    color:#fff;
}
.score-option input:checked+label .indicator-copy{color:#174c38}
.score-option input:focus-visible+label{
    outline:3px solid rgba(34,160,107,.22);
    outline-offset:2px;
}
.eval-eyebrow,.section-kicker,.category-nav__title{font-weight:700}
.eval-hero h1,.section-heading h2{font-weight:700}
.category-code,.category-name,.category-status{font-weight:600}
.category-meta{font-weight:400}
.rubric-code,.max-badge,.score-badge{font-weight:700}
.rubric-card h3{font-weight:600}
.score-option label{font-weight:400}
.indicator-copy{font-weight:400}
.btn-eval{font-weight:600}
.eval-context{display:flex;align-items:flex-end;gap:12px;min-width:min(100%,500px)}.eval-context .journal-switcher{width:100%;min-width:440px}.eval-hero .journal-switcher__label{color:#d8eaff}.eval-hero .journal-switcher select{box-shadow:none}
@media(max-width:800px){.eval-context{align-items:stretch;flex-direction:column}.eval-context .journal-switcher{min-width:0}}
</style>

<div class="self-evaluation">
    <header class="eval-hero">
        <div class="eval-hero__top">
            <div>
                <p class="eval-eyebrow">Instrumen Evaluasi Tata Kelola dan Mutu Artikel Jurnal</p>
                <h1><?= esc($evaluation['journal_name']) ?></h1>
                <p>e-ISSN <?= esc($evaluation['e_issn'] ?: '—') ?></p>
            </div>
            <div class="eval-context"><?= view('components/journal_switcher', ['journalSwitcher' => $journalSwitcher, 'mode' => 'rubric']) ?></div>
        </div>
        <div class="progress-panel">
            <div>
                <div class="progress-copy"><span>Progres penilaian</span><span><?= $completedCount ?> dari <?= $totalItems ?> subunsur (<?= $progressPercent ?>%)</span></div>
                <div class="progress-track"><span style="width:<?= $progressPercent ?>%"></span></div>
            </div>
            <div class="temporary-score"><small>Skor sementara</small><strong><?= $formatScore($gross) ?> / 100</strong></div>
        </div>
    </header>

    <div class="eval-layout">
        <nav class="category-nav" aria-label="Unsur penilaian">
            <p class="category-nav__title">Unsur penilaian</p>
            <?php foreach ($categories as $code => $category): ?>
                <?php $progress = $categoryProgress[$code]; $done = $progress['total'] > 0 && $progress['completed'] === $progress['total']; ?>
                <a class="category-link <?= $activeCategory === $code ? 'active' : '' ?>" href="<?= site_url('jurnal/evaluasi/' . $evaluation['id'] . '/rubrik') ?>?category=<?= $code ?>">
                    <span class="category-code"><?= $code ?></span>
                    <span class="category-name"><?= esc($category['label']) ?><span class="category-meta"><?= $progress['completed'] ?>/<?= $progress['total'] ?> terisi · <?= $formatScore($progress['score']) ?>/<?= $formatScore($category['max']) ?></span></span>
                    <span class="category-status <?= $done ? 'done' : '' ?>"><?= $done ? '✓' : $progress['completed'] ?></span>
                </a>
            <?php endforeach ?>
        </nav>

        <main class="eval-main">
            <div class="section-heading">
                <div class="section-heading__line">
                    <div><p class="section-kicker">Unsur <?= $activeCategory ?> · <?= esc($activeProgress['group']) ?></p><h2><?= esc($activeProgress['label']) ?></h2><p>Pilih satu skor yang paling sesuai untuk setiap subunsur berdasarkan kondisi dan bukti jurnal.</p></div>
                    <div class="section-score"><small>Nilai unsur <?= $activeCategory ?></small><strong><?= $formatScore($activeProgress['score']) ?> / <?= $formatScore($activeProgress['max']) ?></strong></div>
                </div>
            </div>

            <form class="eval-form" method="post" action="<?= site_url('jurnal/evaluasi/' . $evaluation['id'] . '/rubrik') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="category" value="<?= $activeCategory ?>">
                <?php if (session('success')): ?><div class="eval-notice success"><?= esc(session('success')) ?></div><?php endif ?>
                <?php if (session('error')): ?><div class="eval-notice error"><?= esc(session('error')) ?></div><?php endif ?>
                <p class="required-note"><b>*</b> Pilih satu skor yang paling sesuai pada setiap subunsur berdasarkan pertimbangan dan kondisi jurnal.</p>

                <?php foreach ($activeItems as $item): ?>
                    <?php
                    $itemId = (string) $item['id'];
                    $oldScore = old('score.' . $itemId);
                    $hasOldScore = $oldScore !== null;
                    $hasSavedScore = array_key_exists('score', $item['saved']);
                    ?>
                    <article class="rubric-card">
                        <div class="rubric-card__head"><div><span class="rubric-code"><?= esc($item['code']) ?></span><h3><?= esc($item['label']) ?></h3></div><span class="max-badge">Maks. <?= $formatScore($item['max_score']) ?> poin</span></div>
                        <div class="option-list">
                            <?php foreach ($item['options'] as $optionIndex => $option): ?>
                                <?php
                                $isChecked = $hasOldScore
                                    ? (float) $oldScore === (float) $option['score']
                                    : ($hasSavedScore && (float) $item['saved']['score'] === (float) $option['score']);
                                $optionId = 'score-' . $itemId . '-' . $optionIndex;
                                ?>
                                <div class="score-option">
                                    <input type="radio" id="<?= $optionId ?>" name="score[<?= $itemId ?>]" value="<?= esc($option['score']) ?>" <?= $isChecked ? 'checked' : '' ?> required>
                                    <label for="<?= $optionId ?>"><span class="score-badge">Skor <?= $formatScore($option['score']) ?></span><span class="indicator-copy"><?= esc($option['indicator']) ?></span></label>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </article>
                <?php endforeach ?>

                <div class="form-actions">
                    <div class="action-group">
                        <?php if ($previousCategory !== null): ?><a class="btn-eval btn-secondary" href="<?= site_url('jurnal/evaluasi/' . $evaluation['id'] . '/rubrik') ?>?category=<?= $previousCategory ?>">← Sebelumnya</a><?php endif ?>
                        <a class="btn-eval btn-secondary" href="<?= site_url('jurnal/evaluasi/' . $evaluation['id']) ?>">Kriteria Jurnal</a>
                    </div>
                    <button class="btn-eval btn-primary" type="submit"><?= $activeCategory === 'G' ? 'Simpan & Lihat Hasil' : 'Simpan & Lanjutkan →' ?></button>
                </div>
            </form>
        </main>
    </div>

    <?php if ($isComplete): ?>
        <section class="final-summary">
            <h2>Hasil Akhir Simulasi</h2><p>Seluruh <?= $totalItems ?> subunsur A–G telah dievaluasi.</p>
            <div class="final-grid">
                <div class="result-box"><small>Tata Kelola A–E</small><strong><?= $formatScore($management) ?> / 46</strong></div>
                <div class="result-box"><small>Mutu Artikel F–G</small><strong><?= $formatScore($quality) ?> / 54</strong></div>
                <div class="result-box"><small>Nilai Akhir</small><strong><?= $formatScore($total) ?> / 100</strong></div>
                <div class="result-box highlight"><small>Proyeksi Akreditasi</small><strong><?= esc($rank) ?></strong></div>
            </div>
            <?php if ($deduction > 0): ?><p class="disclaimer">Nilai sebelum disinsentif <?= $formatScore($gross) ?>, dikurangi disinsentif <?= $formatScore($deduction) ?> poin.</p><?php endif ?>
            <p class="disclaimer">Hasil ini merupakan simulasi evaluasi diri berdasarkan rubrik 2026 dan bukan penetapan akreditasi resmi.</p>
        </section>
    <?php else: ?>
        <section class="final-summary locked"><div class="lock-icon">🔒</div><div><h2>Hasil akhir belum tersedia</h2><p>Lengkapi <?= $totalItems - $completedCount ?> subunsur yang tersisa. Skor sementara tetap tersimpan dan dapat dilanjutkan kapan saja.</p></div></section>
    <?php endif ?>
</div>

<?= $this->endSection() ?>
