<?php

namespace App\Controllers;

use App\Services\JournalSwitcherService;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\Rubric2026;

class RubricController extends BaseController
{
    private const CATEGORY_CODES = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];

    public function show(int $id)
    {
        if (! $this->criteriaPassed($id)) {
            return redirect()->to('/jurnal/evaluasi/' . $id)
                ->with('error', 'Selesaikan dan lulus Evaluasi Kriteria Jurnal sebelum membuka Evaluasi Diri.');
        }

        $data = $this->data($id);
        $requestedCategory = strtoupper(trim((string) $this->request->getGet('category')));

        if (! in_array($requestedCategory, self::CATEGORY_CODES, true)) {
            $requestedCategory = $this->firstIncompleteCategory($data['categoryProgress']) ?? 'A';
        }

        $data['activeCategory'] = $requestedCategory;

        return view('rubrics/show', $data);
    }

    public function save(int $id)
    {
        if (! $this->criteriaPassed($id)) {
            return redirect()->to('/jurnal/evaluasi/' . $id)
                ->with('error', 'Evaluasi Diri masih terkunci karena Evaluasi Kriteria Jurnal belum lulus.');
        }

        $data = $this->data($id);
        $category = strtoupper(trim((string) $this->request->getPost('category')));

        if (! in_array($category, self::CATEGORY_CODES, true)) {
            throw PageNotFoundException::forPageNotFound();
        }

        $categoryItems = array_values(array_filter(
            $data['items'],
            static fn (array $item): bool => $item['category'] === $category
        ));
        $postedScores = (array) $this->request->getPost('score');
        $missing = [];

        foreach ($categoryItems as $item) {
            $key = (string) $item['id'];
            if (! array_key_exists($key, $postedScores)) {
                $missing[] = $item['code'];
                continue;
            }

            $allowedScores = array_map(static fn (array $option): string => self::scoreKey($option['score']), $item['options']);
            if (! in_array(self::scoreKey($postedScores[$key]), $allowedScores, true)) {
                $missing[] = $item['code'];
            }
        }

        if ($missing !== []) {
            return redirect()->to('/jurnal/evaluasi/' . $id . '/rubrik?category=' . $category)
                ->withInput()
                ->with('error', 'Pilih skor untuk seluruh subunsur ' . implode(', ', $missing) . '.');
        }

        $db = db_connect();
        $db->transStart();
        foreach ($categoryItems as $item) {
            $key = (string) $item['id'];
            $db->table('rubric_scores')->replace([
                'evaluation_id'  => $id,
                'rubric_item_id' => $item['id'],
                'score'          => (float) $postedScores[$key],
                'evidence_url'   => $item['saved']['evidence_url'] ?? null,
                'reason'         => $item['saved']['reason'] ?? null,
                'follow_up'      => $item['saved']['follow_up'] ?? null,
                'updated_at'     => date('Y-m-d H:i:s'),
            ]);
        }
        $db->transComplete();

        if (! $db->transStatus()) {
            log_message('error', 'Gagal menyimpan rubrik evaluasi {evaluation}', ['evaluation' => $id]);
            return redirect()->back()->withInput()->with('error', 'Nilai rubrik gagal disimpan. Silakan coba kembali.');
        }

        $position = array_search($category, self::CATEGORY_CODES, true);
        $nextCategory = self::CATEGORY_CODES[$position + 1] ?? $category;
        $message = $category === 'G'
            ? 'Unsur G tersimpan. Hasil akhir tersedia setelah seluruh unsur A–G lengkap.'
            : 'Unsur ' . $category . ' tersimpan. Silakan lanjutkan ke unsur ' . $nextCategory . '.';

        return redirect()->to('/jurnal/evaluasi/' . $id . '/rubrik?category=' . $nextCategory)
            ->with('success', $message);
    }

    public function addDisincentive(int $id)
    {
        if (! $this->criteriaPassed($id)) {
            return redirect()->to('/jurnal/evaluasi/' . $id)->with('error', 'Evaluasi Diri masih terkunci.');
        }

        $this->data($id);
        $type = trim((string) $this->request->getPost('type'));
        $deduction = (float) $this->request->getPost('deduction');
        $evidenceUrl = trim((string) $this->request->getPost('evidence_url'));
        $allowedTypes = ['integritas_1_artikel', 'integritas_2_3_artikel', 'integritas_lebih_3_artikel', 'ethical_clearance'];
        $allowedDeductions = [3.0, 10.0, 15.0, 20.0];

        if (! in_array($type, $allowedTypes, true) || ! in_array($deduction, $allowedDeductions, true)) {
            return redirect()->back()->with('error', 'Jenis atau nilai disinsentif tidak valid.');
        }
        if ($evidenceUrl !== '' && (strlen($evidenceUrl) > 255 || filter_var($evidenceUrl, FILTER_VALIDATE_URL) === false || ! in_array(parse_url($evidenceUrl, PHP_URL_SCHEME), ['http', 'https'], true))) {
            return redirect()->back()->with('error', 'URL bukti disinsentif tidak valid.');
        }
        if (mb_strlen((string) $this->request->getPost('notes')) > 5000) {
            return redirect()->back()->with('error', 'Catatan disinsentif maksimal 5.000 karakter.');
        }

        db_connect()->table('disincentives')->insert([
            'evaluation_id' => $id,
            'type'          => $type,
            'deduction'     => $deduction,
            'evidence_url'  => $evidenceUrl ?: null,
            'notes'         => trim((string) $this->request->getPost('notes')) ?: null,
            'created_at'    => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Disinsentif dicatat.');
    }

    private function criteriaPassed(int $evaluationId): bool
    {
        $db = db_connect();
        $initialPassed = $db->table('eligibility_answers')
            ->join('eligibility_items', 'eligibility_items.id = eligibility_answers.item_id')
            ->where('eligibility_answers.evaluation_id', $evaluationId)
            ->where('eligibility_items.section', 'awal')
            ->where('eligibility_answers.status', 'sesuai')
            ->countAllResults() === 15;
        $feasibilityPassed = $db->table('eligibility_answers')
            ->join('eligibility_items', 'eligibility_items.id = eligibility_answers.item_id')
            ->where('eligibility_answers.evaluation_id', $evaluationId)
            ->where('eligibility_items.section', 'kelayakan')
            ->where('eligibility_answers.status', 'sesuai')
            ->countAllResults() === 2;

        return $initialPassed && $feasibilityPassed;
    }

    private function data(int $id): array
    {
        $db = db_connect();
        $evaluation = $db->table('evaluations')
            ->select('evaluations.*, journals.name AS journal_name, journals.e_issn')
            ->join('journals', 'journals.id = evaluations.journal_id')
            ->where('evaluations.id', $id)
            ->get()->getRowArray();

        if ($evaluation === null || ! $db->table('journal_admins')->where([
            'journal_id' => $evaluation['journal_id'],
            'user_id'    => session('user_id'),
        ])->countAllResults()) {
            throw PageNotFoundException::forPageNotFound();
        }

        $rubric = new Rubric2026();
        $items = $db->table('rubric_items')->orderBy('sort_order')->get()->getResultArray();
        $saved = array_column(
            $db->table('rubric_scores')->where('evaluation_id', $id)->get()->getResultArray(),
            null,
            'rubric_item_id'
        );
        $totals = array_fill_keys(self::CATEGORY_CODES, 0.0);
        $categoryProgress = [];

        foreach ($rubric->categories as $code => $category) {
            $categoryProgress[$code] = $category + ['total' => 0, 'completed' => 0, 'score' => 0.0];
        }

        foreach ($items as &$item) {
            $item['options'] = $db->table('rubric_options')
                ->where('rubric_item_id', $item['id'])
                ->orderBy('score', 'DESC')->get()->getResultArray();
            $item['saved'] = $saved[$item['id']] ?? [];
            $categoryProgress[$item['category']]['total']++;

            if (isset($saved[$item['id']])) {
                $score = (float) $saved[$item['id']]['score'];
                $totals[$item['category']] += $score;
                $categoryProgress[$item['category']]['completed']++;
                $categoryProgress[$item['category']]['score'] += $score;
            }
        }
        unset($item);

        $completedCount = count($saved);
        $totalItems = count($items);
        $isComplete = $totalItems > 0 && $completedCount === $totalItems;
        $management = $totals['A'] + $totals['B'] + $totals['C'] + $totals['D'] + $totals['E'];
        $quality = $totals['F'] + $totals['G'];
        $gross = $management + $quality;
        $row = $db->table('disincentives')->selectSum('deduction')->where('evaluation_id', $id)->get()->getRowArray();
        $deduction = (float) ($row['deduction'] ?? 0);
        $total = max(0, $gross - $deduction);
        $rank = $this->rank($total);

        return compact(
            'items', 'management', 'quality', 'gross', 'deduction', 'total', 'rank',
            'completedCount', 'totalItems', 'isComplete', 'categoryProgress'
        ) + [
            'title'      => 'Evaluasi Diri A–G',
            'evaluation' => $evaluation,
            'categories' => $rubric->categories,
            'reference'  => $rubric->reference,
            'journalSwitcher' => (new JournalSwitcherService())->forUser((int) $evaluation['journal_id']),
        ];
    }

    private function firstIncompleteCategory(array $progress): ?string
    {
        foreach ($progress as $code => $category) {
            if ($category['completed'] < $category['total']) {
                return $code;
            }
        }

        return null;
    }

    private function rank(float $total): string
    {
        return $total >= 90 ? 'Terakreditasi Peringkat 1'
            : ($total >= 80 ? 'Terakreditasi Peringkat 2'
                : ($total >= 70 ? 'Terakreditasi Peringkat 3'
                    : ($total >= 60 ? 'Terakreditasi Peringkat 4' : 'Tidak Terakreditasi')));
    }

    private static function scoreKey(mixed $score): string
    {
        return rtrim(rtrim(number_format((float) $score, 2, '.', ''), '0'), '.');
    }
}
