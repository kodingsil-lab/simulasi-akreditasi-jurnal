<?php

namespace App\Controllers;

use App\Models\JournalModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class JournalController extends BaseController
{
    public function show(int $id): string
    {
        $journal = (new JournalModel())->find($id);
        if ($journal === null) {
            throw PageNotFoundException::forPageNotFound();
        }
        return view('journals/show', ['title' => $journal['name'], 'journal' => $journal]);
    }
}
