<?php 

namespace App\Http\Controllers\ORM;

use Request;
use Exception;

use App\Http\Controllers\Controller;
use App\Models\ORM\Post;
use App\Models\ORM\Category;
use App\Models\ORM\Tag;

use App\Exceptions\CrudException;
use App\Exceptions\NotFoundException;

class PostController extends Controller {

    /**
    * Display a listing of the Post.
    *
    * @return Response
    */
    public function index()
    {
        $posts = Post::all();
        return $posts;
    }

    /**
    * Show the form for creating a new Post.
    *
    * @return Response
    */
    public function create()
    {

    }

    /**
    * Store a newly created Post in storage.
    *
    * @return Response
    */
    public function store()
    {
        $params = Request::all();
        $post = new Post($params);
        $tags = isset($params['tags']) ? $params['tags'] : [];

        if ($post->save()) {
            $post->tags()->attach($tags);
            return $post;
        } else
        throw new CrudException('post:store');
    }

    /**
    * Display the specified Post.
    *
    * @param  string  $slug
    * @return Response
    */
    public function show($slug)
    {
        $post = Post::where('slug', '=', $slug)->first();
        if ($post) {
            return $post; 
        } else
        throw new NotFoundException('\'Post\' not found.');
    }

    /**
    * Display the specified Post by Category.
    *
    * @param  int  $id
    * @return Response
    */
    public function category($slug)
    {
        $category = Category::where('slug', '=', $slug)->first();
        $posts = Post::where('category_id', '=', $category->id)->get();
        return $posts;
    }

    /**
    * Display the specified Post by Category.
    *
    * @param  int  $id
    * @return Response
    */
    public function tag($slug)
    {
        $posts = Tag::where('slug', '=', $slug)->first()->posts()->get();
        return $posts;
    }

    /**
    * Show the form for editing the specified Post.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {

    }

    /**
    * Update the specified Post in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id)
    {
        $post = Post::find($id);
        $params = Request::all();
        $tags = $params['tags'];
        unset($params['tags']);        

        if ($post) {
            
            foreach ($params as $key => $value)
                $post->{$key} = $value;

            $post->tags()->detach();
            $post->tags()->attach($tags);

            if ($post->save())
                return $post;
        }
        throw new CrudException('post:update');
    }

    /**
    * Remove the specified Post from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            $params = Request::all();
            return $post;
        }
        throw new CrudException('post:destroy');
    }
}

?>