<?php

namespace App\Repositories;

use App\Http\Resources\CategoryLocationCollection;
use App\Models\Category;
use App\Models\CategoryLocation;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getCategories(){
        return CategoryLocation::with(['categories' => function($query){
            $query->with(['subCategories', /*'books' => function($booksQuery){
                $booksQuery->wherePivot('category_id', '=', DB::raw("(SELECT id from categories where name='best sellers')"));
                $booksQuery->with('authors');
            }*/]);
        }])->get();
    }

    public function getGroupedCategories(){
        return $this->getCategories()->mapToGroups(function ($item, $key) {
            return [CategoryLocationCollection::$locationMap[$item['location_id']] => $item->categories];
        })->all();
    }
}
