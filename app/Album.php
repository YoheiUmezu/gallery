<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable=['name'];

    public function images(){
        return $this->hasMany(Image::class);
    }
}
