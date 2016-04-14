<?php

namespace App\Http\Controllers;

use \App\Blog;

class BlogController extends Controller {

    public function getNames() {
        $blog_name = env('BLOG_NAME');
        $blog = new Blog($blog_name);
        $names = $blog->allNames();

        if (!$names) {
            $this->layout->error = 'Couldn\'t find any tags or posts or something????';
            $this->layout->content = view('main');
            return;
        }

        $view_variables = [
            'names' => $names,
            'blog' => $blog_name,
        ];

        return $this->setPageContent(view('names.list', $view_variables));
    }

    public function getNamesJson() {
        $blog = new Blog(env('BLOG_NAME'));
        $names = $blog->allNames();
        return response()->json($names);
    }
}
