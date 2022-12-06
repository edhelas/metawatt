<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $sources = [];

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function addSource(string $key, string $title, string $url)
    {
        $this->sources[$key] = [
            'title' => $title,
            'url' => $url
        ];
    }
}
