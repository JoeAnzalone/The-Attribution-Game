<?php

namespace App\Http\Controllers;

use \App\Blog;

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
        $blog = new Blog(env('BLOG_NAME'));
        $post = $blog->randomQuotePost();
        $correct = $post->tags ? $post->tags[0] : 'Unknown';
        $correct = ucwords($correct);
        $choices = $blog->randomNames(4, $correct);

        $view_variables = ['post' => $post, 'choices' => $choices];

        return $this->setPageContent(view('main', $view_variables));
    }
}
