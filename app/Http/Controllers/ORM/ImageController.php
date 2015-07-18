<?php 

namespace App\Http\Controllers\ORM;

use Request;
use Exception;

use App\Models\ORM\Image;

use App\Http\Controllers\Controller;
use App\Exceptions\CrudException;

class ImageController extends Controller {

    /**
    * Display a listing of the Image.
    *
    * @return Response
    */
    public function index()
    {
        $images = Image::all();
        return $images;
    }

    /**
    * Show the form for creating a new Image.
    *
    * @return Response
    */
    public function create()
    {

    }

    /**
    * Store a newly created Image in storage.
    *
    * @return Response
    */
    public function store()
    {
        $image = new Image(Request::all());
        if ($image->save()) {
            $params = Request::all();
            return $image;
        } else
        throw new CrudException('image:store');
    }

    /**
    * Display the specified Image.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
        $image = Image::find($id);
        if ($image) {
            return $image; 
        } else
        throw new CrudException('image:show');
    }

    /**
    * Show the form for editing the specified Image.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {

    }

    /**
    * Update the specified Image in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id)
    {
        $image = Image::find($id);
        if ($image) {
            foreach (Request::all() as $key => $value)
                $image->{$key} = $value;
            if ($image->save())
                return $image;
        }
        throw new CrudException('image:update');
    }

    /**
    * Remove the specified Image from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        $image = Image::find($id);
        if ($image) {
            $image->delete();
            $params = Request::all();
            return $image;
        }
        throw new CrudException('image:destroy');
    }

    /**
    * Get posts of the image.
    *
    * @return Response
    */
    public function getPosts($id)
    {
        $image = Image::find($id);
        if ($image) {
            $posts = $image->posts()->get();
            return $posts;
        }
        throw new CrudException('image:getPosts');
    }


}

?>