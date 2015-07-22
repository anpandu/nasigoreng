<?php 

namespace App\Http\Controllers\ORM;

use Request;
use Exception;
use Storage;
use File;
use Carbon\Carbon;

use App\Models\ORM\Image;

use App\Http\Controllers\Controller;
use App\Exceptions\FileUploadException;
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
        // $a = '>>>|';
        // foreach (Request::all() as $key => $value) $a .=  $key . ':::' . $value . '|';
        // return $a;

        $valid_ext = ['jpg', 'png', 'bmp', 'gif', 'jpeg'];

        if (!Request::hasFile('image'))
            throw new FileUploadException('image not found');
        if (!Request::file('image')->isValid())
            throw new FileUploadException('image is not valid');

        $params = Request::all();

        $file = $params['image'];
        unset($params['image']);

        if (!in_array($file->getClientOriginalExtension(), $valid_ext))
            throw new FileUploadException('image type is not valid');

        $file_name = Carbon::now()->format('Ymd_His_') . $params['title'] . '.' . $file->getClientOriginalExtension();
        $file_path = 'images/';

        $params['filename'] = $file_name;
        $image = new Image($params);
        if ($image->save()) {
            Storage::put($file_path . $file_name, File::get($file));
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
            $file_path = 'images/';
            $file_name = $image->filename;
            $image->delete();
            Storage::delete($file_path . $file_name);
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