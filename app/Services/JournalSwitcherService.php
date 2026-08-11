<?php

namespace App\Services;

class JournalSwitcherService
{
    public function forUser(int $selectedJournalId = 0): array
    {
        if ($selectedJournalId <= 0) {
            $selectedJournalId = (int) session('active_journal_id');
        }

        $db = db_connect();
        $journals = $db->table('journals')
            ->select('journals.id, journals.name, journals.e_issn')
            ->join('journal_admins', 'journal_admins.journal_id = journals.id')
            ->where('journal_admins.user_id', session('user_id'))
            ->where('journals.is_active', 1)
            ->orderBy('journals.name')->get()->getResultArray();

        foreach ($journals as &$journal) {
            $evaluation = $db->table('evaluations')->where('journal_id', $journal['id'])
                ->orderBy('period_year', 'DESC')->orderBy('id', 'DESC')->get()->getRowArray();
            $criteriaPassed = false;
            if ($evaluation !== null) {
                $criteriaPassed = $db->table('eligibility_answers')
                    ->where('evaluation_id', $evaluation['id'])->where('status', 'sesuai')
                    ->countAllResults() === 17;
            }

            $criteriaUrl = $evaluation !== null
                ? site_url('jurnal/evaluasi/' . $evaluation['id'])
                : site_url('jurnal/' . $journal['id'] . '/kriteria');
            $journal['evaluation_id'] = $evaluation['id'] ?? null;
            $journal['period_year'] = $evaluation['period_year'] ?? (int) date('Y');
            $journal['criteria_passed'] = $criteriaPassed;
            $journal['dashboard_url'] = site_url('jurnal') . '?journal=' . $journal['id'];
            $journal['criteria_url'] = $criteriaUrl;
            $journal['rubric_url'] = $criteriaPassed
                ? site_url('jurnal/evaluasi/' . $evaluation['id'] . '/rubrik')
                : $criteriaUrl;
        }
        unset($journal);

        $ids = array_map(static fn (array $journal): int => (int) $journal['id'], $journals);
        if (! in_array($selectedJournalId, $ids, true)) {
            $selectedJournalId = $ids[0] ?? 0;
        }

        if ($selectedJournalId > 0) {
            session()->set('active_journal_id', $selectedJournalId);
        }

        return ['journals' => $journals, 'selected_id' => $selectedJournalId];
    }
}
