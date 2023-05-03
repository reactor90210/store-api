<?php

namespace App\Repositories\Interfaces;

interface CategoryLocationRepositoryInterface
{
    public function createCategoryLocation($category_id, $location_id);
    public function updateCategoryLocation($category_id, $location_id);
    public function deleteCategoryLocation($category_id);
}
