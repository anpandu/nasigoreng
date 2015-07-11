<?php

namespace App\Models\ORM;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'slug'];

    public function posts()
    {
        return $this->belongsToMany('App\Models\ORM\Post');
    }

}
