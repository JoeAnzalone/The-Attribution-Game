<?php

namespace App\Http\Controllers;

use \App\Blog;
use Illuminate\Http\Request;

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

    public function checkAnswer(Request $request)
    {
        $blog = new Blog(env('BLOG_NAME'));
        $post_id = $request->input('post_id', false);
        $post = $blog->getPost($post_id);

        $correct_answer = $post->tags ? $post->tags[0] : 'Unknown';
        $guess = $request->input('guess', false);

        $is_correct = ($correct_answer === $guess);

        $view_variables = [
            'post' => $post,
            'is_correct' => $is_correct,
            'correct_answer' => $correct_answer,
            'guess' => $guess,
            'choices' => [],
        ];

        return $this->setPageContent(view('main', $view_variables));
    }
}
