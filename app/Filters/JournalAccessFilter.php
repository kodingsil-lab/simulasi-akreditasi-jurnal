<?php

namespace App\Filters;

use App\Services\JournalAccessService;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class JournalAccessFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $mode = $arguments[0] ?? 'journal';
        $resourceId = (int) ($mode === 'evaluation'
            ? $request->getUri()->getSegment(3)
            : $request->getUri()->getSegment(2));
        $access = new JournalAccessService();
        $allowed = $mode === 'evaluation'
            ? $access->canAccessEvaluation((int) session('user_id'), $resourceId, (string) session('role'))
            : $access->canAccessJournal((int) session('user_id'), $resourceId, (string) session('role'));

        if (! $allowed) {
            log_message('warning', 'Akses objek jurnal ditolak untuk user {user}, mode {mode}, objek {object}', [
                'user' => (int) session('user_id'), 'mode' => $mode, 'object' => $resourceId,
            ]);

            return service('response')->setStatusCode(404)->setBody(view('errors/html/error_404'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
