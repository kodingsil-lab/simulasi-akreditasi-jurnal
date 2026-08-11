<?php

namespace App\Controllers;

use App\Models\JournalAdminModel;
use App\Models\JournalModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class JournalManagementController extends BaseController
{
    private JournalModel $journals;

    public function __construct()
    {
        $this->journals = new JournalModel();
    }

    public function index(): string
    {
        $journals = $this->assigned()->orderBy('journals.name')->findAll();
        return view('journals/manage/index', ['title' => 'Data Jurnal', 'journals' => $journals]);
    }

    public function create(): string
    {
        return view('journals/manage/form', ['title' => 'Tambah Jurnal', 'journal' => null]);
    }

    public function store()
    {
        if (! $this->validateInput()) return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        $db = db_connect();
        $db->transStart();
        $id = $this->journals->insert($this->payload());
        (new JournalAdminModel())->insert(['journal_id' => $id, 'user_id' => session('user_id')]);
        $db->transComplete();
        if (! $db->transStatus()) {
            return redirect()->back()->withInput()->with('error', 'Jurnal gagal disimpan. Silakan coba kembali.');
        }
        return redirect()->to('/jurnal/data')->with('success', 'Jurnal berhasil ditambahkan.');
    }

    public function edit(int $id): string
    {
        return view('journals/manage/form', ['title' => 'Edit Jurnal', 'journal' => $this->owned($id)]);
    }

    public function update(int $id)
    {
        $this->owned($id);
        if (! $this->validateInput($id)) return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        $this->journals->update($id, $this->payload($id));
        return redirect()->to('/jurnal/data')->with('success', 'Data jurnal berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $this->owned($id);
        $this->journals->delete($id);
        if ((int) session('active_journal_id') === $id) {
            session()->remove('active_journal_id');
        }
        return redirect()->to('/jurnal/data')->with('success', 'Jurnal dan evaluasinya telah dihapus.');
    }

    private function assigned()
    {
        return $this->journals->select('journals.*')->join('journal_admins', 'journal_admins.journal_id = journals.id')->where('journal_admins.user_id', session('user_id'));
    }

    private function owned(int $id): array
    {
        $journal = $this->assigned()->where('journals.id', $id)->first();
        if ($journal === null) throw PageNotFoundException::forPageNotFound();
        return $journal;
    }

    private function validateInput(?int $id = null): bool
    {
        return $this->validateData($this->request->getPost(), ['name' => 'required|max_length[191]', 'e_issn' => 'permit_empty|max_length[20]', 'website_url' => 'permit_empty|valid_url|max_length[255]', 'publisher' => 'permit_empty|max_length[191]', 'frequency' => 'permit_empty|max_length[80]', 'first_published_year' => 'permit_empty|integer|greater_than[1900]|less_than_equal_to[2100]', 'doi_prefix' => 'permit_empty|max_length[100]']);
    }

    private function payload(?int $ignoreId = null): array
    {
        $name = trim((string) $this->request->getPost('name'));
        return ['name' => $name, 'slug' => $this->uniqueSlug($name, $ignoreId), 'e_issn' => trim((string) $this->request->getPost('e_issn')) ?: null, 'website_url' => trim((string) $this->request->getPost('website_url')) ?: null, 'publisher' => trim((string) $this->request->getPost('publisher')) ?: null, 'scope' => trim((string) $this->request->getPost('scope')) ?: null, 'frequency' => trim((string) $this->request->getPost('frequency')) ?: null, 'first_published_year' => $this->request->getPost('first_published_year') ?: null, 'doi_prefix' => trim((string) $this->request->getPost('doi_prefix')) ?: null];
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $ascii = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $name) ?: $name;
        $base = trim((string) preg_replace('/[^a-z0-9]+/i', '-', strtolower($ascii)), '-');
        $base = substr($base ?: 'jurnal', 0, 180);
        $slug = $base;
        $number = 2;

        while (true) {
            $query = $this->journals->where('slug', $slug);
            if ($ignoreId !== null) {
                $query->where('id !=', $ignoreId);
            }
            if ($query->first() === null) {
                break;
            }
            $slug = $base . '-' . $number++;
        }

        return $slug;
    }
}
