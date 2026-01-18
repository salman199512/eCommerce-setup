<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ProductDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Admin\CreateProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Action;
use App\Models\Attribute;
use App\Models\AttributeGroup;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Repositories\Admin\ProductRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Response;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\File;
class ProductController extends AppBaseController
{
    /** @var ProductRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepository = $productRepo;
    }

    public function index(ProductDataTable $productDataTable)
    {
        return $productDataTable->render('admin.products.index');
    }

    public function create()
    {
        $categories = Category::where('status', 1)->pluck('title', 'id');
        $brands = Brand::where('status', 1)->pluck('name', 'id');
        $subCategories = SubCategory::where('status', 1)->pluck('title', 'id');
        $attributeGroups = AttributeGroup::where('status', 1)->pluck('title', 'id');

        return view('admin.products.create', compact('categories', 'subCategories', 'attributeGroups', 'brands'));
    }

    public function store(CreateProductRequest $request)
    {
        $input = ProductRepository::requestHandler($request);
        $this->productRepository->create($input);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Product saved successfully.');
        return Response::json(['message' => 'Product has been created successfully.',
            'back_url' => route('admin.products.index')]);
    }

    public function show(Product $product)
    {
        return view('admin.products.show')->with('product', $product);
    }

    public function edit(Product $product)
    {
        $categories = Category::where('status', 1)->pluck('title', 'id');
        $brands = Brand::where('status', 1)->pluck('name', 'id');
        $subCategories = SubCategory::where('status', 1)->pluck('title', 'id');
        $attributeGroups = AttributeGroup::where('status', 1)->pluck('title', 'id');
        $mediaUrls = [];
        if (!empty($product)) {
            $mediaCollection = Media::where('model_id', $product->id)
                ->where('collection_name', 'product_images')
                ->get();


            foreach ($mediaCollection as $media) {
                $ext = File::extension($media->file_name);

                $size = ($media->size / 1024);
                $mediaUrls[] = [
                    'url' => $media->getUrl(),
                    'uuid' => $media->uuid,
                    'file_name' => $media->file_name,
                    'id' => $media->id,
                    'ext' => File::extension($media->file_name),
                    'file_size_mb' => $size,
                ];


            }

        }


        $product->load(['variants.attributes', 'attributes']);

        return view('admin.products.edit', compact('product', 'mediaUrls','categories', 'subCategories', 'attributeGroups', 'brands'));
    }

    public function update(Product $product, UpdateProductRequest $request)
    {
        $input = ProductRepository::requestHandler($request);

        $this->productRepository->update($input, $product->id);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Product updated successfully.');

        return Response::json(['message' => 'Product has been updated successfully.',
            'back_url' => route('admin.products.index')]);
    }

    public function destroy(Product $product)
    {
        $this->productRepository->delete($product->id);
        return Response::json(['message' => 'Product deleted successfully']);
    }

    public function statusChange(Product $product)
    {
        $product->status = !$product->status;
        $product->save();
        return Response::json(['message' => 'Product status updated successfully']);
    }

    // Creating this to handle AJAX fetching of attributes for a group
    public function getAttributes(Request $request)
    {
        $groupIds = $request->get('group_ids', []);
        $attributes = Attribute::whereIn('attribute_group_id', $groupIds)
                                ->where('status', 1)
                                ->get(['id', 'title', 'attribute_group_id']);
        return response()->json($attributes);
    }
}
