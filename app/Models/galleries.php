<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class galleries extends Model
{
    use HasFactory;

    public  $uploadDrectory = '/storage/auth/posts/';

    public const POST_IMAGE = 1;
    protected $fillable = ['image','type'];

    public function image() : Attribute
    {
        return Attribute::make(
            get: fn($image)=>$this->uploadDrectory. $image
        );
    }
}
