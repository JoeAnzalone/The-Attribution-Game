<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function showQuiz()
    {
        $view_variables = [];
        return $this->setPageContent(view('main', $view_variables));
    }
}
