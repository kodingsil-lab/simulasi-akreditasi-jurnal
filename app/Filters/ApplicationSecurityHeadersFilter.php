<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class ApplicationSecurityHeadersFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if (! headers_sent()) {
            header_remove('X-Powered-By');
        }

        return $response
            ->removeHeader('X-Powered-By')
            ->setHeader('Permissions-Policy', 'camera=(), microphone=(), geolocation=()')
            ->setHeader('Cross-Origin-Opener-Policy', 'same-origin');
    }
}
