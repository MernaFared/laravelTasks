<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExploreItem extends Model
{
    use HasFactory;
    protected $fillable = ['image', 'title', 'rating', 'price', 'description', 'is_featured'];

}
 
