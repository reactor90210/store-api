<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Repositories\Interfaces\BookRepositoryInterface;

class BookController extends Controller
{
    private BookRepositoryInterface $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function getBooksByCategory($category_id){
        return new BookCollection($this->bookRepository->getBooksByCategory($category_id));
    }

    public function getBookById($id){
        return new BookResource($this->bookRepository->getBookById($id));
    }

    public function getBookBySlug($slug){
        return new BookResource($this->bookRepository->getBookBySlug($slug));
    }
}
