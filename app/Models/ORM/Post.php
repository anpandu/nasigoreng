<?php

namespace App\Models\ORM;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'slug', 'content', 'header_img', 'category_id'];

    public function category()
    {
        return $this->belongsTo('App\Models\ORM\Category');
    }

    public function getCategory()
    {
        return $this->category()->get()->first();
    }

}
