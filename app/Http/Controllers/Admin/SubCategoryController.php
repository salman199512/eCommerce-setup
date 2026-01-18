<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SubCategoryDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Admin\CreateSubCategoryRequest;
use App\Http\Requests\Admin\UpdateSubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Repositories\Admin\SubCategoryRepository;
use Illuminate\Http\Request;
use Response;

class SubCategoryController extends AppBaseController
{
    /** @var SubCategoryRepository */
    private $subCategoryRepository;

    public function __construct(SubCategoryRepository $subCategoryRepo)
    {
        $this->subCategoryRepository = $subCategoryRepo;
    }

    /**
     * Display a listing of the SubCategory.
     *
     * @param SubCategoryDataTable $subCategoryDataTable
     * @return Response
     */
    public function index(SubCategoryDataTable $subCategoryDataTable)
    {
        return $subCategoryDataTable->render('admin.sub_categories.index');
    }

    /**
     * Show the form for creating a new SubCategory.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)->pluck('title', 'id');
        return view('admin.sub_categories.create', compact('categories'));
    }

    /**
     * Store a newly created SubCategory in storage.
     *
     * @param CreateSubCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateSubCategoryRequest $request)
    {
        $input = SubCategoryRepository::requestHandler($request);

        $this->subCategoryRepository->create($input);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'SubCategory saved successfully.');

        return Response::json(['message' => 'SubCategory has been created successfully.',
            'back_url' => route('admin.sub-categories.index')]);
    }

    /**
     * Display the specified SubCategory.
     *
     * @param SubCategory $subCategory
     * @return Response
     */
    public function show(SubCategory $subCategory)
    {
        return view('admin.sub_categories.show')->with('subCategory', $subCategory);
    }

    /**
     * Show the form for editing the specified SubCategory.
     *
     * @param SubCategory $subCategory
     * @return Response
     */
    public function edit(SubCategory $subCategory)
    {
        $categories = Category::where('status', 1)->pluck('title', 'id');
        return view('admin.sub_categories.edit', compact('subCategory', 'categories'));
    }

    /**
     * Update the specified SubCategory in storage.
     *
     * @param SubCategory $subCategory
     * @param UpdateSubCategoryRequest $request
     *
     * @return Response
     */
    public function update(SubCategory $subCategory, UpdateSubCategoryRequest $request)
    {
        $input = SubCategoryRepository::requestHandler($request);

        $this->subCategoryRepository->update($input, $subCategory->id);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'SubCategory updated successfully.');
        return Response::json(['message' => 'SubCategory has been updated successfully.',
            'back_url' => route('admin.sub-categories.index')]);
    }

    /**
     * Remove the specified SubCategory from storage.
     *
     * @param SubCategory $subCategory
     * @return Response
     */
    public function destroy(SubCategory $subCategory)
    {
        $this->subCategoryRepository->delete($subCategory->id);

        return Response::json(['message' => 'SubCategory deleted successfully']);
    }

    /**
     * Change status of the specified SubCategory.
     *
     * @param SubCategory $subCategory
     * @return Response
     */
    public function statusChange(SubCategory $subCategory)
    {
        $subCategory->status = !$subCategory->status;
        $subCategory->save();

        return Response::json(['message' => 'SubCategory status updated successfully']);
    }
}
