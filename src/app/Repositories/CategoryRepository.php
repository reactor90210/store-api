<?php

namespace App\Repositories;

use App\Http\Resources\CategoryLocationCollection;
use App\Models\Category;
use App\Models\CategoryLocation;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

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

    public function getParentCategories(){
        return Category::whereNull('parent_id')->get();
    }

    public function getCategoryWithParent($id){
        return Category::with(['parentCategory', 'locations'])
                        ->where('id', $id)
                        ->first();
    }

    public function getCategoriesWithParent(){
        return Category::with('parentCategory')->get();
    }

    public function createCategory($categoryDetails){
        return Category::create([
            'name' => $categoryDetails->name,
            'parent_id' => !empty($categoryDetails->parent_id) ? $categoryDetails->parent_id : null
        ]);
    }

    public function updateCategory($categoryDetails, $id){
        return Category::where('id', $id)
                        ->update([
                            'name' => $categoryDetails->name,
                            'parent_id' => !empty($categoryDetails->parent_id) ? $categoryDetails->parent_id : null
                        ]);
    }

    public function deleteCategory($id){
        return Category::where('id', $id)->delete();
    }

    public function getFreeCategories(){
        return Category::whereDoesntHave('subCategories')->get();
        //return Category::all();
    }
}
