<?php

namespace App\Repositories;

use App\Models\CategoryLocation;
use App\Repositories\Interfaces\CategoryLocationRepositoryInterface;

class CategoryLocationRepository implements CategoryLocationRepositoryInterface
{
    public function createCategoryLocation($category_id, $location_id){
        return CategoryLocation::create([
            'category_id' => $category_id,
            'location_id' => $location_id
        ]);
    }

    public function updateCategoryLocation($category_id, $location_id){
        return CategoryLocation::where('category_id', $category_id)
                                ->update(['location_id' => $location_id]);
    }

    public function deleteCategoryLocation($category_id){
        return CategoryLocation::where('category_id', $category_id)->delete();
    }
}
