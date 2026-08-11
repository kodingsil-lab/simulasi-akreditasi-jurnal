<?php

namespace App\Controllers;

use App\Services\JournalSwitcherService;
use Config\Rubric2026;

class DocumentationController extends BaseController
{
    public function index(): string
    {
        $rubric = new Rubric2026();
        $journalSwitcher = (new JournalSwitcherService())->forUser();
        $activeJournal = null;

        foreach ($journalSwitcher['journals'] as $journal) {
            if ((int) $journal['id'] === (int) $journalSwitcher['selected_id']) {
                $activeJournal = $journal;
                break;
            }
        }

        return view('documentation/index', [
            'title'           => 'Dokumentasi Akreditasi',
            'categories'      => $rubric->categories,
            'rubricItems'     => $rubric->items,
            'journalSwitcher' => $journalSwitcher,
            'activeJournal'   => $activeJournal,
        ]);
    }
}
