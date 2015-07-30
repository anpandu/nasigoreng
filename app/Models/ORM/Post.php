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
    protected $fillable = ['title', 'slug', 'content', 'description', 'header_image', 'category_id', 'user_id'];

    public function category()
    {
        return $this->belongsTo('App\Models\ORM\Category');
    }

    public function getCategory()
    {
        return $this->category()->get()->first();
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\ORM\Tag');
    }

    public function simpleAttributes()
    {
        return parent::toArray();
    }

    public function toArray()
    {
        $result = parent::toArray();
        $result['category'] = $this->getCategory()->simpleAttributes();
        $result['tags'] = $this->tags()->get()->map(function($x){return $x->simpleAttributes();})->toArray();
        return $result;
    }

}
