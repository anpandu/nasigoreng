<?php 

namespace App\Http\Controllers\ORM;

use Request;
use Exception;

use App\Models\ORM\Category;

use App\Http\Controllers\Controller;
use App\Exceptions\CrudException;

class CategoryController extends Controller {

    /**
    * Display a listing of the Category.
    *
    * @return Response
    */
    public function index()
    {
        $categories = Category::all();
        return $categories;
    }

    /**
    * Show the form for creating a new Category.
    *
    * @return Response
    */
    public function create()
    {

    }

    /**
    * Store a newly created Category in storage.
    *
    * @return Response
    */
    public function store()
    {
        $category = new Category(Request::all());
        if ($category->save()) {
            $params = Request::all();
            return $category;
        } else
        throw new CrudException('category:store');
    }

    /**
    * Display the specified Category.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
        $category = Category::find($id);
        if ($category) {
            return $category; 
        } else
        throw new CrudException('category:show');
    }

    /**
    * Show the form for editing the specified Category.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {

    }

    /**
    * Update the specified Category in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id)
    {
        $category = Category::find($id);
        if ($category) {
            foreach (Request::all() as $key => $value)
                $category->{$key} = $value;
            if ($category->save())
                return $category;
        }
        throw new CrudException('category:update');
    }

    /**
    * Remove the specified Category from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            $params = Request::all();
            return $category;
        }
        throw new CrudException('category:destroy');
    }

    /**
    * Get posts of the category.
    *
    * @return Response
    */
    public function getPosts($id)
    {
        $category = Category::find($id);
        if ($category) {
            $posts = $category->posts()->get();
            return $posts;
        }
        throw new CrudException('category:getPosts');
    }


}

?>