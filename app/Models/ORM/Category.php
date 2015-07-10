<?php

namespace App\Models\ORM;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'slug'];

    public function posts()
    {
        return $this->hasMany('App\Models\ORM\Post');
    }

}
