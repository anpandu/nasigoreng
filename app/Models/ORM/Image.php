<?php

namespace App\Models\ORM;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'slug', 'filename', 'description'];

    public function simpleAttributes()
    {
        return parent::toArray();
    }

}
