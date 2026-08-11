<?php

namespace App\Controllers;

use App\Services\JournalSwitcherService;

class DashboardController extends BaseController
{
    public function index()
    {
        return session('role') === 'super_admin'
            ? redirect()->to('/admin')
            : redirect()->to('/jurnal');
    }

    public function superAdmin(): string
    {
        $db = db_connect();
        $users = $db->table('users')->where('role', 'admin_jurnal');
        $totalUsers = (clone $users)->countAllResults();
        $activeUsers = (clone $users)->where('is_active', 1)->countAllResults();
        $monthStart = date('Y-m-01 00:00:00');

        return view('dashboard_super', [
            'title' => 'Operator Sistem',
            'stats' => [
                'users' => $totalUsers,
                'active' => $activeUsers,
                'inactive' => $totalUsers - $activeUsers,
                'new_this_month' => (clone $users)->where('created_at >=', $monthStart)->countAllResults(),
            ],
            'recentUsers' => (clone $users)->select('name, email, is_active, created_at')
                ->orderBy('created_at', 'DESC')->limit(6)->get()->getResultArray(),
        ]);
    }

    public function journalAdmin(): string
    {
        $db = db_connect();
        $journals = $db->table('journals')
            ->select('journals.*')
            ->join('journal_admins', 'journal_admins.journal_id = journals.id')
            ->where('journal_admins.user_id', session('user_id'))
            ->where('journals.is_active', 1)
            ->orderBy('journals.name')->get()->getResultArray();
        $totalRubricItems = $db->table('rubric_items')->countAllResults();

        foreach ($journals as &$journal) {
            $evaluation = $db->table('evaluations')
                ->where('journal_id', $journal['id'])
                ->orderBy('period_year', 'DESC')->orderBy('id', 'DESC')
                ->get()->getRowArray();
            $journal['evaluation_id'] = $evaluation['id'] ?? null;
            $journal['period_year'] = $evaluation['period_year'] ?? (int) date('Y');
            $journal['initial_completed'] = 0;
            $journal['initial_passed'] = 0;
            $journal['feasibility_completed'] = 0;
            $journal['feasibility_passed'] = 0;
            $journal['rubric_completed'] = 0;
            $journal['rubric_total'] = $totalRubricItems;
            $journal['score'] = 0.0;
            $journal['deduction'] = 0.0;

            if ($evaluation !== null) {
                $answerSummary = $db->table('eligibility_items')
                    ->select("eligibility_items.section, COUNT(eligibility_answers.id) completed, SUM(eligibility_answers.status = 'sesuai') passed", false)
                    ->join('eligibility_answers', 'eligibility_answers.item_id = eligibility_items.id AND eligibility_answers.evaluation_id = ' . (int) $evaluation['id'], 'left')
                    ->groupBy('eligibility_items.section')->get()->getResultArray();

                foreach ($answerSummary as $summary) {
                    $prefix = $summary['section'] === 'awal' ? 'initial' : 'feasibility';
                    $journal[$prefix . '_completed'] = (int) $summary['completed'];
                    $journal[$prefix . '_passed'] = (int) $summary['passed'];
                }

                $rubricSummary = $db->table('rubric_scores')
                    ->select('COUNT(*) completed, COALESCE(SUM(score), 0) score', false)
                    ->where('evaluation_id', $evaluation['id'])->get()->getRowArray();
                $journal['rubric_completed'] = (int) ($rubricSummary['completed'] ?? 0);
                $journal['score'] = (float) ($rubricSummary['score'] ?? 0);

                if ($db->tableExists('disincentives')) {
                    $deduction = $db->table('disincentives')->selectSum('deduction')->where('evaluation_id', $evaluation['id'])->get()->getRowArray();
                    $journal['deduction'] = (float) ($deduction['deduction'] ?? 0);
                }
            }

            $journal['final_score'] = max(0, $journal['score'] - $journal['deduction']);
            $journal['initial_ready'] = $journal['initial_passed'] === 15;
            $journal['criteria_ready'] = $journal['initial_ready'] && $journal['feasibility_passed'] === 2;
            $journal['rubric_ready'] = $totalRubricItems > 0 && $journal['rubric_completed'] === $totalRubricItems;
            $journal['profile_completed'] = count(array_filter([
                $journal['name'], $journal['e_issn'], $journal['website_url'], $journal['publisher'],
                $journal['scope'], $journal['frequency'], $journal['first_published_year'], $journal['doi_prefix'],
            ], static fn ($value): bool => $value !== null && trim((string) $value) !== ''));
            $journal['profile_percent'] = (int) round(($journal['profile_completed'] / 8) * 100);

            if ($evaluation === null) {
                $journal['stage'] = 'Belum dimulai';
                $journal['stage_tone'] = 'neutral';
                $journal['next_label'] = 'Mulai Evaluasi Kriteria';
                $journal['next_url'] = site_url('jurnal/' . $journal['id'] . '/kriteria');
            } elseif (! $journal['initial_ready']) {
                $journal['stage'] = 'Pemeriksaan awal';
                $journal['stage_tone'] = 'warning';
                $journal['next_label'] = 'Lanjutkan Pemeriksaan Awal';
                $journal['next_url'] = site_url('jurnal/evaluasi/' . $evaluation['id']);
            } elseif (! $journal['criteria_ready']) {
                $journal['stage'] = 'Pemeriksaan kelayakan';
                $journal['stage_tone'] = 'warning';
                $journal['next_label'] = 'Lanjutkan Pemeriksaan Kelayakan';
                $journal['next_url'] = site_url('jurnal/evaluasi/' . $evaluation['id']) . '?section=kelayakan';
            } elseif (! $journal['rubric_ready']) {
                $journal['stage'] = 'Evaluasi diri A–G';
                $journal['stage_tone'] = 'progress';
                $journal['next_label'] = $journal['rubric_completed'] > 0 ? 'Lanjutkan Evaluasi Diri' : 'Mulai Evaluasi Diri';
                $journal['next_url'] = site_url('jurnal/evaluasi/' . $evaluation['id'] . '/rubrik');
            } else {
                $journal['stage'] = 'Evaluasi selesai';
                $journal['stage_tone'] = 'success';
                $journal['next_label'] = 'Lihat Hasil Evaluasi';
                $journal['next_url'] = site_url('jurnal/evaluasi/' . $evaluation['id'] . '/rubrik');
            }
        }
        unset($journal);

        $journalSwitcher = (new JournalSwitcherService())->forUser((int) $this->request->getGet('journal'));
        $journals = array_values(array_filter(
            $journals,
            static fn (array $journal): bool => (int) $journal['id'] === (int) $journalSwitcher['selected_id']
        ));

        return view('dashboard_journal', [
            'title'    => 'Dashboard Jurnal',
            'journals' => $journals,
            'journalSwitcher' => $journalSwitcher,
        ]);
    }
}
