<?php 

namespace App\Http\Controllers\ORM;

use Request;
use Exception;

use App\Models\ORM\Post;

use App\Http\Controllers\Controller;
use App\Exceptions\CrudException;

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
        $post = new Post(Request::all());
        if ($post->save()) {
            $params = Request::all();
            return $post;
        } else
        throw new CrudException('post:store');
    }

    /**
    * Display the specified Post.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
        $post = Post::find($id);
        if ($post) {
            return $post; 
        } else
        throw new CrudException('post:show');
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
        if ($post) {
            foreach (Request::all() as $key => $value)
                $post->{$key} = $value;
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