<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\BrandDataTable;
use App\Http\Requests\Admin\CreateBrandRequest;
use App\Http\Requests\Admin\UpdateBrandRequest;
use App\Models\Brand;
use App\Repositories\Admin\BrandRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class BrandController extends AppBaseController
{
    /** @var  BrandRepository */
    private $brandRepository;

    public function __construct(BrandRepository $brandRepo)
    {
        $this->middleware('permission:brands.index')->only(['index',]);
        $this->middleware('permission:brands.create')->only(['create','store']);
        $this->middleware('permission:brands.edit')->only(['edit','update']);
        $this->middleware('permission:brands.view')->only('show');
        $this->middleware('permission:brands.delete')->only('destroy');
        $this->brandRepository = $brandRepo;
    }

    public function index(BrandDataTable $brandDataTable)
    {
        return $brandDataTable->render('admin.brands.index');
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(CreateBrandRequest $request)
    {
        $input = BrandRepository::requestHandler($request);

        $brand = $this->brandRepository->create($input);

        $this->brandRepository->updateOrCreate_brand_icon($brand, $request);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Brand saved successfully.');
        return Response::json(['message' => 'Brand has been created successfully.',
            'back_url' => route('admin.brands.index')]);
    }

    public function show($id)
    {
        $brand = $this->brandRepository->find($id);

        if (empty($brand)) {
            return redirect(route('admin.brands.index'));
        }

        return view('admin.brands.show')->with('brand', $brand);
    }

    public function edit(Brand $brand)
    {

        if (empty($brand)) {
            return redirect(route('admin.brands.index'));
        }

        return view('admin.brands.edit')->with('brand', $brand);
    }

    public function update(Brand $brand, UpdateBrandRequest $request)
    {
        $input = BrandRepository::requestHandler($request);

        $brand = $this->brandRepository->update($input, $brand->id);

        $this->brandRepository->updateOrCreate_brand_icon($brand, $request);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Brand updated successfully.');

        return Response::json(['message' => 'Brand has been updated successfully.',
            'back_url' => route('admin.brands.index')]);
    }

    public function destroy(Brand $brand)
    {
        $this->brandRepository->delete($brand->id);

        return Response::json(['message' => 'Brand deleted successfully']);
    }

    public function statusChange(Brand $brand)
    {
        $brand->status = !$brand->status;
        $brand->save();

        return Response::json(['message' => 'Brand status updated successfully']);
    }
}
