<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'content', 'image', 'status', 'category_id', 'user_id'];

    protected $primaryKey = 'id'; 

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
