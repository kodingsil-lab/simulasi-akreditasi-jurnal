<?php $targetKey = ($mode ?? 'dashboard') . '_url'; ?>
<?php if (count($journalSwitcher['journals'] ?? []) > 1): ?>
    <label class="journal-switcher">
        <span class="journal-switcher__label">Jurnal aktif</span>
        <span class="journal-switcher__control">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M5 4h11a3 3 0 0 1 3 3v13H7a2 2 0 0 1-2-2V4Z"/><path d="M8 9h7M8 13h7"/></svg>
            <select aria-label="Ganti jurnal aktif" onchange="if(this.value){window.location.href=this.value}">
                <?php foreach ($journalSwitcher['journals'] as $switchJournal): ?>
                    <option value="<?= esc($switchJournal[$targetKey]) ?>" <?= (int) $switchJournal['id'] === (int) $journalSwitcher['selected_id'] ? 'selected' : '' ?>><?= esc($switchJournal['name']) ?></option>
                <?php endforeach ?>
            </select>
        </span>
    </label>
<?php endif ?>
