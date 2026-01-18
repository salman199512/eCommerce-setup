<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\CategoryDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Admin\CreateCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use App\Repositories\Admin\CategoryRepository;
use Illuminate\Http\Request;
use Response;

class CategoryController extends AppBaseController
{
    /** @var CategoryRepository */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the Category.
     *
     * @param CategoryDataTable $categoryDataTable
     * @return Response
     */
    public function index(CategoryDataTable $categoryDataTable)
    {
        return $categoryDataTable->render('admin.categories.index');
    }

    /**
     * Show the form for creating a new Category.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param CreateCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $input = CategoryRepository::requestHandler($request);

        $this->categoryRepository->create($input);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Category saved successfully.');
        return Response::json(['message' => 'Category has been created successfully.',
            'back_url' => route('admin.categories.index')]);
    }

    /**
     * Display the specified Category.
     *
     * @param Category $category
     * @return Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified Category.
     *
     * @param Category $category
     * @return Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit')->with('category', $category);
    }

    /**
     * Update the specified Category in storage.
     *
     * @param Category $category
     * @param UpdateCategoryRequest $request
     *
     * @return Response
     */
    public function update(Category $category, UpdateCategoryRequest $request)
    {
        $input = CategoryRepository::requestHandler($request);

        $this->categoryRepository->update($input, $category->id);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Category updated successfully.');

        return Response::json(['message' => 'Category has been updated successfully.',
            'back_url' => route('admin.categories.index')]);
    }

    /**
     * Remove the specified Category from storage.
     *
     * @param Category $category
     * @return Response
     */
    public function destroy(Category $category)
    {
        $this->categoryRepository->delete($category->id);

        return Response::json(['message' => 'Category deleted successfully']);
    }

    /**
     * Change status of the specified Category.
     *
     * @param Category $category
     * @return Response
     */
    public function statusChange(Category $category)
    {
        $category->status = !$category->status;
        $category->save();

        return Response::json(['message' => 'Category status updated successfully']);
    }
}
