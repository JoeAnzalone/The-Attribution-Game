<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public $postsPerPage = 20;

    public function __construct($blog_name) {
        $this->blog_name = $blog_name;
        $this->client    = $client = new \Tumblr\API\Client(
                                        env('TUMBLR.CONSUMER_KEY')
                                    );
    }

    private function _totalPosts() {
        $response = $this->client->getBlogInfo($this->blog_name);
        return $response->blog->posts;
    }

    private function _namesByOffset($offset) {

        $options = ['offset' => $offset, 'type' => 'quote'];
        $response = $this->client->getBlogPosts($this->blog_name, $options);
        $names = [];

        foreach ($response->posts as $post) {
            if (count($post->tags)) {
                $names[] = ucwords($post->tags[0]);
            }
        }

        return $names;
    }

    public function allNames() {
        $total_posts = $this->_totalPosts();
        $pages = round($total_posts / $this->postsPerPage);

        $names = [];

        for ($i=0; $i < $pages; $i++) {
            $add_tags = $this->_namesByOffset($i * $this->postsPerPage);
            if ($add_tags) {
                $names = array_merge($names, $add_tags);
            }
        }
        $names = array_unique($names);
        $names = array_values($names);

        return $names;
    }
}
