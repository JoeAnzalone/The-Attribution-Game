<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $layout = 'layouts.master';

    protected function setPageContent($content)
    {
        return view($this->layout, [
            'content' => $content,
            'analytics' => view('analytics'),
        ]);
    }
}
