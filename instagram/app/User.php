<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $incrementing = false;
    protected $fillable = [
      'id',
      'full_name',
      'profile_picture',
      'username',
      'created_at',
      'updated_at'
    ];

    public function image() {
        $this->hasMany(Image::class);
    }
}
