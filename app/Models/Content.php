<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'heading1', 'heading2', 'heading3', 'content1', 'content2', 'content3', 'image1', 'image2', 'image3', 'url1', 'url2', 'button1', 'button2', 'position', 'page', 'status'];
}
