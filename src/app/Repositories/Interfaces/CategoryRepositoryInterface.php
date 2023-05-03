<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{
    public function getCategories();
    public function getParentCategories();
    public function getCategoryWithParent($id);
    public function getCategoriesWithParent();
    public function createCategory($categoryDetails);
    public function updateCategory($categoryDetails, $id);
    public function deleteCategory($id);
    public function getFreeCategories();
}
