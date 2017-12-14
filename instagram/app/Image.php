<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $incrementing =false;
    protected $fillable = [
        'id',
        'text',
        'created_time',
        'width',
        'height',
        'url',
        'created_at',
        'updated_at'
    ];

    public function image() {
        $this->belongsTo(Image::class);
    }
}
