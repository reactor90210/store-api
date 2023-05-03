<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryLocationCollection;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CategoryLocationRepositoryInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{

    public function __construct(CategoryRepositoryInterface $categoryRepository, CategoryLocationRepositoryInterface $categoryLocationRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryLocationRepository = $categoryLocationRepository;
    }

    public function getTable(){
        return view('categories.index');
    }
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return DataTables::of($this->categoryRepository->getCategoriesWithParent())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $parent_categories = $this->categoryRepository->getParentCategories();
        $free_categories = $this->categoryRepository->getFreeCategories();

        //dd($free_categories);

        return view('categories.create', ['parent_categories'=>$parent_categories,
                                                'free_categories'=>$free_categories,
                                                'locations' => CategoryLocationCollection::$locationMap]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(StoreCategoryRequest $request)
    {
        //dd($request->all());
        $category = $this->categoryRepository->createCategory($request);

        if(!empty($category->id) && !empty($request->location_id)){
            $this->categoryLocationRepository->createCategoryLocation($category->id, $request->location_id);
        }

        return redirect('admin/categories-table');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->getCategoryWithParent($id);
        $parent_categories = $this->categoryRepository->getParentCategories();

        $selected_locations = $category->locations->pluck('location_id')->toArray();
        $free_categories = $this->categoryRepository->getFreeCategories($id);
        //dd($free_categories);

        return view('categories.edit', ['category' =>$category,
                                            'selected_locations' => $selected_locations,
                                            'parent_categories'=> $parent_categories,
                                            'free_categories' => $free_categories,
                                            'locations' => CategoryLocationCollection::$locationMap]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {

        dd($request->all());
        $this->categoryRepository->updateCategory($request, $id);
        $this->categoryLocationRepository->updateCategoryLocation($request->id, $request->location_id);

        return redirect('admin/categories-table');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $this->categoryRepository->deleteCategory($id);
        $this->categoryLocationRepository->deleteCategoryLocation($id);

        return redirect('admin/categories-table');
    }
}
