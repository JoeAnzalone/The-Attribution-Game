<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Cache;

class Blog extends Model
{
    public $postsPerPage = 20;

    public function __construct($blog_name) {
        $this->blog_name = $blog_name;
        $this->client    = $client = new \Tumblr\API\Client(
                                        env('TUMBLR.CONSUMER_KEY')
                                    );
    }

    private function _totalPosts($type = null) {
        $response = $this->client->getBlogPosts($this->blog_name, ['type' => $type, 'limit' => 1]);
        return $response->total_posts;
    }

    private function _namesByOffset($offset, $limit = 20) {

        $options = ['offset' => $offset, 'limit' => $limit, 'type' => 'quote'];
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
        if (Cache::has('allNames')) {
            return Cache::get('allNames');
        }

        $total_posts = $this->_totalPosts();
        $pages = round($total_posts / $this->postsPerPage);

        $names = [];

        for ($i=0; $i < $pages; $i++) {
            $add_tags = $this->_namesByOffset($i * $this->postsPerPage, $this->postsPerPage);
            if ($add_tags) {
                $names = array_merge($names, $add_tags);
            }
        }
        $names = array_unique($names);
        $names = array_values($names);

        Cache::put('allNames', $names, 60);

        return $names;
    }

    public function randomNames($how_many_total = 4, $include = false) {
        $all_names = $this->allNames();

        if ($include && ($key = array_search($include, $all_names)) !== false) {
            unset($all_names[$key]);
        }

        $how_many_random = $include ? $how_many_total - 1 : $how_many_total;
        $name_keys = array_rand($all_names, $how_many_random);

        foreach ($name_keys as $key) {
            $names[] = $all_names[$key];
        }

        if ($include) {
            $names[] = $include;
        }

        shuffle($names);

        return $names;
    }

    public function randomQuotePost() {
        $total_posts = $this->_totalPosts('quote');
        $offset = rand(0, $total_posts - 1);
        $options = ['offset' => $offset, 'limit' => 1, 'type' => 'quote'];
        $response = $this->client->getBlogPosts($this->blog_name, $options);

        return $response->posts[0];
    }

    public function getPost($id) {
        $options = ['id' => $id];
        $response = $this->client->getBlogPosts($this->blog_name, $options);

        return $response->posts[0];
    }
}
