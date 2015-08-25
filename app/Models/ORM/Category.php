<?php

namespace App\Models\ORM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    public function simpleAttributes()
    {
        return parent::toArray();
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
