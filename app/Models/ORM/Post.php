<?php

namespace App\Models\ORM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
    protected $fillable = ['title', 'content', 'description', 'header_image', 'category_id', 'user_id'];

    public function category()
    {
        return $this->belongsTo('App\Models\ORM\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\ORM\User');
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
        $result['user'] = $this->user()->first()->toArray();
        return $result;
    }

    public function save(array $options = [])
    {
        $seed = $this->title;
        do {
            $this->slug = Str::slug($seed);
            $exist = self::where('slug', '=', $this->slug)->first();
            $again = (($exist!==null)&&($exist->id!=$this->id));
            $seed .= ' New';
        } while ($again);
        return parent::save();
    }

}
