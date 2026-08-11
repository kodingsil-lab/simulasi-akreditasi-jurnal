<?php

namespace App\Services;

class JournalAccessService
{
    public function canAccessJournal(int $userId, int $journalId, ?string $role = null): bool
    {
        if ($userId < 1 || $journalId < 1) {
            return false;
        }

        $role ??= (string) session('role');
        if ($role !== 'admin_jurnal') {
            return false;
        }

        return db_connect()->table('journal_admins')
            ->where('journal_id', $journalId)
            ->where('user_id', $userId)
            ->countAllResults() === 1;
    }

    public function journalIdForEvaluation(int $evaluationId): ?int
    {
        if ($evaluationId < 1) {
            return null;
        }

        $row = db_connect()->table('evaluations')
            ->select('journal_id')
            ->where('id', $evaluationId)
            ->get()->getRowArray();

        return $row === null ? null : (int) $row['journal_id'];
    }

    public function canAccessEvaluation(int $userId, int $evaluationId, ?string $role = null): bool
    {
        $journalId = $this->journalIdForEvaluation($evaluationId);

        return $journalId !== null && $this->canAccessJournal($userId, $journalId, $role);
    }
}
