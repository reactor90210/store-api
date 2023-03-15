<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function subCategories()
    {
        return $this->hasMany(self::class, 'parent_id')->with('subCategories');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

    public function locations()
    {
        return $this->belongsTo(CategoryLocation::class);
    }
}
