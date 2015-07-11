<?php 

namespace App\Http\Controllers\ORM;

use Request;
use Exception;

use App\Models\ORM\Tag;

use App\Http\Controllers\Controller;
use App\Exceptions\CrudException;

class TagController extends Controller {

    /**
    * Display a listing of the Tag.
    *
    * @return Response
    */
    public function index()
    {
        $tags = Tag::all();
        return $tags;
    }

    /**
    * Show the form for creating a new Tag.
    *
    * @return Response
    */
    public function create()
    {

    }

    /**
    * Store a newly created Tag in storage.
    *
    * @return Response
    */
    public function store()
    {
        $tag = new Tag(Request::all());
        if ($tag->save()) {
            $params = Request::all();
            return $tag;
        } else
        throw new CrudException('tag:store');
    }

    /**
    * Display the specified Tag.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
        $tag = Tag::find($id);
        if ($tag) {
            return $tag; 
        } else
        throw new CrudException('tag:show');
    }

    /**
    * Show the form for editing the specified Tag.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {

    }

    /**
    * Update the specified Tag in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id)
    {
        $tag = Tag::find($id);
        if ($tag) {
            foreach (Request::all() as $key => $value)
                $tag->{$key} = $value;
            if ($tag->save())
                return $tag;
        }
        throw new CrudException('tag:update');
    }

    /**
    * Remove the specified Tag from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        if ($tag) {
            $tag->delete();
            $params = Request::all();
            return $tag;
        }
        throw new CrudException('tag:destroy');
    }

    /**
    * Get posts of the tag.
    *
    * @return Response
    */
    public function getPosts($id)
    {
        $tag = Tag::find($id);
        if ($tag) {
            $posts = $tag->posts()->get();
            return $posts;
        }
        throw new CrudException('tag:getPosts');
    }


}

?>