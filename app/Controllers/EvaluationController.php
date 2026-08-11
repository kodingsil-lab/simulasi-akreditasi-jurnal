<?php

namespace App\Controllers;

use App\Models\JournalModel;
use App\Services\JournalSwitcherService;
use CodeIgniter\Exceptions\PageNotFoundException;

class EvaluationController extends BaseController
{
    private const ITEM_GUIDANCE = [
        'Validitas laman jurnal' => 'Pastikan laman jurnal aktif, dapat diakses tanpa kesalahan, dan benar-benar merupakan laman jurnal yang sedang dievaluasi.',
        'Validitas nama jurnal sesuai ISSN' => 'Pastikan nama jurnal pada laman, metadata artikel, dan galley PDF sama dengan nama yang tercatat pada Portal ISSN.',
        'Validitas penerbit jurnal sesuai ISSN' => 'Pastikan nama penerbit pada laman jurnal sama dengan data penerbit yang tercatat pada Portal ISSN.',
        'Kesesuaian jenis dan waktu usulan' => 'Pastikan jenis pengajuan dan waktu pengajuan sesuai dengan status jurnal, masa berlaku akreditasi, serta ketentuan pengajuan baru atau akreditasi ulang.',
        'Kesesuaian frekuensi terbitan' => 'Pastikan frekuensi penerbitan pada arsip sesuai dengan frekuensi yang dinyatakan pada laman jurnal dan data ISSN, sekurang-kurangnya dua kali dalam satu tahun.',
        'Keberkalaan jurnal tiga tahun terakhir' => 'Pastikan jurnal terbit teratur selama tiga tahun berturut-turut dan setiap nomor terbitan memuat sekurang-kurangnya lima artikel.',
        'Pencantuman peringkat dan masa berlaku' => 'Jika jurnal telah terakreditasi, pastikan peringkat dan masa berlakunya dicantumkan secara benar, mutakhir, dan tidak menyesatkan pada laman jurnal.',
        'Laman etika publikasi' => 'Pastikan tersedia halaman etika publikasi yang dapat diakses dan memuat kebijakan etika penerbitan sesuai standar yang berlaku.',
        'Laman biaya pemrosesan artikel' => 'Pastikan biaya pemrosesan atau penerbitan artikel dijelaskan secara terbuka; jika tidak dipungut biaya, kondisi tersebut tetap harus dinyatakan.',
        'Ketersediaan DOI aktif' => 'Pastikan setiap artikel mempunyai DOI yang aktif dan dapat diarahkan melalui DOI resolver ke laman artikel yang benar.',
        'Ketersediaan teks penuh pada setiap artikel' => 'Pastikan teks lengkap atau galley PDF setiap artikel tersedia, dapat dibuka, dan dapat dibaca dari laman jurnal.',
        'Kecukupan keberagaman afiliasi Tim Editor' => 'Pastikan Tim Editor mempunyai afiliasi yang valid dan cukup beragam, tidak hanya berasal dari institusi penerbit, serta kepakarannya sesuai fokus jurnal.',
        'Kecukupan keberagaman afiliasi Mitra Bestari' => 'Pastikan Mitra Bestari mempunyai afiliasi yang valid dan cukup beragam, kepakarannya sesuai, serta benar-benar terlibat dalam penelaahan.',
        'Validitas username dan password' => 'Pastikan username dan kata sandi akun pemeriksaan valid serta dapat digunakan untuk masuk ke sistem manajemen jurnal.',
        'Ketersediaan kredensial/peran Editor' => 'Pastikan akun pemeriksaan mempunyai peran Editor sehingga proses pengelolaan, penelaahan, dan penerbitan artikel dapat ditelusuri.',
        'Setiap artikel telah melalui penelaahan oleh Mitra Bestari' => 'Pastikan setiap artikel yang diterbitkan mempunyai bukti penelaahan substantif oleh Mitra Bestari yang kepakarannya sesuai dan dapat ditelusuri di sistem jurnal.',
        'Validitas dan integritas penerbit serta kepatuhan etika publikasi' => 'Pastikan identitas dan rekam jejak penerbit dapat diverifikasi serta tidak ditemukan pelanggaran etika publikasi, etika penerbitan, atau integritas akademik.',
    ];

    public function start(int $journalId)
    {
        $this->assertJournalAccess($journalId);
        $evaluation = $this->findOrCreateEvaluation($journalId, (int) date('Y'));

        return redirect()->to('/jurnal/evaluasi/' . $evaluation['id']);
    }

    public function create(int $journalId)
    {
        $this->assertJournalAccess($journalId);
        $year = (int) $this->request->getPost('period_year');

        if ($year < 2000 || $year > 2100) {
            return redirect()->back()->with('error', 'Tahun evaluasi tidak valid.');
        }

        $evaluation = $this->findOrCreateEvaluation($journalId, $year);

        return redirect()->to('/jurnal/evaluasi/' . $evaluation['id']);
    }

    public function show(int $id): string
    {
        $data = $this->data($id);
        $requestedSection = $this->request->getGet('section') === 'kelayakan' ? 'kelayakan' : 'awal';
        $data['activeSection'] = $requestedSection === 'kelayakan' && $data['initialPassed'] ? 'kelayakan' : 'awal';

        return view('evaluations/show', $data);
    }

    public function save(int $id)
    {
        $data = $this->data($id);
        $section = $this->request->getPost('section') === 'kelayakan' ? 'kelayakan' : 'awal';

        if ($section === 'kelayakan' && ! $data['initialPassed']) {
            return redirect()->to('/jurnal/evaluasi/' . $id)->with('error', 'Pemeriksaan Awal harus lulus sebelum Pemeriksaan Kelayakan dapat diisi.');
        }

        $items = $section === 'awal' ? $data['initialItems'] : $data['feasibilityItems'];
        $fulfilled = (array) $this->request->getPost('fulfilled');
        $db = db_connect();

        $db->transStart();
        foreach ($items as $item) {
            $key = (string) $item['id'];
            $db->table('eligibility_answers')->replace([
                'evaluation_id' => $id,
                'item_id'       => $item['id'],
                'status'        => isset($fulfilled[$key]) ? 'sesuai' : 'belum_sesuai',
                'evidence_url'  => $item['answer']['evidence_url'] ?: null,
                'notes'         => $item['answer']['notes'] ?: null,
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);
        }
        $db->transComplete();

        if (! $db->transStatus()) {
            log_message('error', 'Gagal menyimpan checklist evaluasi {evaluation}', ['evaluation' => $id]);
            return redirect()->back()->withInput()->with('error', 'Checklist gagal disimpan. Silakan coba kembali.');
        }

        $updated = $this->data($id);
        if ($section === 'awal' && $updated['initialPassed']) {
            return redirect()->to('/jurnal/evaluasi/' . $id . '?section=kelayakan')->with('success', 'Pemeriksaan Awal lengkap dan dinyatakan lulus. Silakan lanjutkan Pemeriksaan Kelayakan.');
        }

        $message = $section === 'kelayakan' && $updated['feasibilityPassed']
            ? 'Pemeriksaan Kelayakan lengkap dan dinyatakan lulus.'
            : 'Checklist berhasil disimpan. Lengkapi semua butir untuk melanjutkan.';

        return redirect()->to('/jurnal/evaluasi/' . $id . '?section=' . $section)->with('success', $message);
    }

    private function data(int $id): array
    {
        $db = db_connect();
        $evaluation = $db->table('evaluations')->where('id', $id)->get()->getRowArray();

        if ($evaluation === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->assertJournalAccess((int) $evaluation['journal_id']);
        $items = $db->table('eligibility_items')->orderBy('sort_order')->get()->getResultArray();
        $answers = $db->table('eligibility_answers')->where('evaluation_id', $id)->get()->getResultArray();
        $answerMap = array_column($answers, null, 'item_id');

        foreach ($items as &$item) {
            $item['answer'] = $answerMap[$item['id']] ?? ['status' => 'belum_sesuai', 'evidence_url' => '', 'notes' => ''];
            $item['guidance'] = self::ITEM_GUIDANCE[$item['label']] ?? 'Pastikan unsur pemeriksaan ini telah dipenuhi dan dapat diverifikasi pada sistem jurnal.';
        }
        unset($item);

        $initialItems = array_values(array_filter($items, static fn (array $item): bool => $item['section'] === 'awal'));
        $feasibilityItems = array_values(array_filter($items, static fn (array $item): bool => $item['section'] === 'kelayakan'));
        $initialCompleted = count(array_filter($initialItems, static fn (array $item): bool => $item['answer']['status'] === 'sesuai'));
        $feasibilityCompleted = count(array_filter($feasibilityItems, static fn (array $item): bool => $item['answer']['status'] === 'sesuai'));
        $initialPassed = count($initialItems) === 15 && $initialCompleted === 15;
        $feasibilityPassed = $initialPassed && count($feasibilityItems) === 2 && $feasibilityCompleted === 2;

        return [
            'title'                => 'Evaluasi Kriteria Jurnal',
            'evaluation'           => $evaluation,
            'journal'              => (new JournalModel())->find($evaluation['journal_id']),
            'initialItems'         => $initialItems,
            'feasibilityItems'     => $feasibilityItems,
            'initialCompleted'     => $initialCompleted,
            'feasibilityCompleted' => $feasibilityCompleted,
            'initialPassed'        => $initialPassed,
            'feasibilityPassed'    => $feasibilityPassed,
            'journalSwitcher'      => (new JournalSwitcherService())->forUser((int) $evaluation['journal_id']),
        ];
    }

    private function assertJournalAccess(int $journalId): void
    {
        $assigned = db_connect()->table('journal_admins')->where([
            'journal_id' => $journalId,
            'user_id'    => session('user_id'),
        ])->countAllResults() > 0;

        if (! $assigned) {
            throw PageNotFoundException::forPageNotFound();
        }
    }

    private function findOrCreateEvaluation(int $journalId, int $year): array
    {
        $db = db_connect();
        $evaluation = $db->table('evaluations')->where(['journal_id' => $journalId, 'period_year' => $year])->get()->getRowArray();

        if ($evaluation !== null) {
            return $evaluation;
        }

        $version = $db->table('rubric_versions')->where('is_active', 1)->orderBy('id', 'DESC')->get()->getRowArray();
        $db->table('evaluations')->insert([
            'journal_id'       => $journalId,
            'period_year'      => $year,
            'created_by'       => session('user_id'),
            'rubric_version_id'=> $version['id'] ?? null,
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => date('Y-m-d H:i:s'),
        ]);

        return $db->table('evaluations')->where('id', $db->insertID())->get()->getRowArray();
    }
}
