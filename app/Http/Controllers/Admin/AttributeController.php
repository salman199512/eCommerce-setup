<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\AttributeDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Admin\CreateAttributeRequest;
use App\Http\Requests\Admin\UpdateAttributeRequest;
use App\Models\Attribute;
use App\Models\AttributeGroup;
use App\Repositories\Admin\AttributeRepository;
use Illuminate\Http\Request;
use Response;

class AttributeController extends AppBaseController
{
    /** @var AttributeRepository */
    private $attributeRepository;

    public function __construct(AttributeRepository $attributeRepo)
    {
        $this->attributeRepository = $attributeRepo;
    }

    /**
     * Display a listing of the Attribute.
     *
     * @param AttributeDataTable $attributeDataTable
     * @return Response
     */
    public function index(AttributeDataTable $attributeDataTable)
    {
        return $attributeDataTable->render('admin.attributes.index');
    }

    /**
     * Show the form for creating a new Attribute.
     *
     * @return Response
     */
    public function create()
    {
        $attributeGroups = AttributeGroup::where('status', 1)->pluck('title', 'id');
        return view('admin.attributes.create', compact('attributeGroups'));
    }

    /**
     * Store a newly created Attribute in storage.
     *
     * @param CreateAttributeRequest $request
     *
     * @return Response
     */
    public function store(CreateAttributeRequest $request)
    {
        $input = AttributeRepository::requestHandler($request);

        $this->attributeRepository->create($input);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Attribute saved successfully.');

        return Response::json(['message' => 'Attribute has been created successfully.',
            'back_url' => route('admin.attributes.index')]);
    }

    /**
     * Display the specified Attribute.
     *
     * @param Attribute $attribute
     * @return Response
     */
    public function show(Attribute $attribute)
    {
        return view('admin.attributes.show')->with('attribute', $attribute);
    }

    /**
     * Show the form for editing the specified Attribute.
     *
     * @param Attribute $attribute
     * @return Response
     */
    public function edit(Attribute $attribute)
    {
        $attributeGroups = AttributeGroup::where('status', 1)->pluck('title', 'id');
        return view('admin.attributes.edit', compact('attribute', 'attributeGroups'));
    }

    /**
     * Update the specified Attribute in storage.
     *
     * @param Attribute $attribute
     * @param UpdateAttributeRequest $request
     *
     * @return Response
     */
    public function update(Attribute $attribute, UpdateAttributeRequest $request)
    {
        $input = AttributeRepository::requestHandler($request);

        $this->attributeRepository->update($input, $attribute->id);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Attribute updated successfully.');
        return Response::json(['message' => 'Attribute has been updated successfully.',
            'back_url' => route('admin.attributes.index')]);
    }

    /**
     * Remove the specified Attribute from storage.
     *
     * @param Attribute $attribute
     * @return Response
     */
    public function destroy(Attribute $attribute)
    {
        $this->attributeRepository->delete($attribute->id);

        return Response::json(['message' => 'Attribute deleted successfully']);
    }

    /**
     * Change status of the specified Attribute.
     *
     * @param Attribute $attribute
     * @return Response
     */
    public function statusChange(Attribute $attribute)
    {
        $attribute->status = !$attribute->status;
        $attribute->save();

        return Response::json(['message' => 'Attribute status updated successfully']);
    }
}
