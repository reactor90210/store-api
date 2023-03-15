<?php

namespace App\Repositories\Interfaces;

interface BookRepositoryInterface
{
    public function getBooksByCategory($categoryId);
    public function getBookById($bookId);
}
