<?php

namespace FreshmanGuide\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/image/upload',
        '/image/rotate',
        '/image/insert',
        '/image/onsave',
    ];
}
