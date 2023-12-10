<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryLocationCollection;
use App\Http\Resources\CategoryResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    use ApiResponse;

    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategories(){
       return Cache::remember('categories', 3600, function () {
            return new CategoryLocationCollection($this->categoryRepository->getGroupedCategories());
        });
    }

    public function getCategoryById($category_id, Request $request){
        return new CategoryResource($this->categoryRepository->getCategoryById($category_id, $request->query('page')));
    }

    public function getCategoryBySlug($slug, Request $request){
        return new CategoryResource($this->categoryRepository->getCategoryBySlug($slug, $request->query('page')));
    }
}
