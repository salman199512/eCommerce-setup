<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\AttributeGroupDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Admin\CreateAttributeGroupRequest;
use App\Http\Requests\Admin\UpdateAttributeGroupRequest;
use App\Models\AttributeGroup;
use App\Repositories\Admin\AttributeGroupRepository;
use Illuminate\Http\Request;
use Response;

class AttributeGroupController extends AppBaseController
{
    /** @var AttributeGroupRepository */
    private $attributeGroupRepository;

    public function __construct(AttributeGroupRepository $attributeGroupRepo)
    {
        $this->attributeGroupRepository = $attributeGroupRepo;
    }

    /**
     * Display a listing of the AttributeGroup.
     *
     * @param AttributeGroupDataTable $attributeGroupDataTable
     * @return Response
     */
    public function index(AttributeGroupDataTable $attributeGroupDataTable)
    {
        return $attributeGroupDataTable->render('admin.attribute_groups.index');
    }

    /**
     * Show the form for creating a new AttributeGroup.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.attribute_groups.create');
    }

    /**
     * Store a newly created AttributeGroup in storage.
     *
     * @param CreateAttributeGroupRequest $request
     *
     * @return Response
     */
    public function store(CreateAttributeGroupRequest $request)
    {
        $input = AttributeGroupRepository::requestHandler($request);

        $this->attributeGroupRepository->create($input);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Attribute Group saved successfully.');
        return Response::json(['message' => 'Attribute Group has been created successfully.',
            'back_url' => route('admin.attribute-groups.index')]);
    }

    /**
     * Display the specified AttributeGroup.
     *
     * @param AttributeGroup $attributeGroup
     * @return Response
     */
    public function show(AttributeGroup $attributeGroup)
    {
        return view('admin.attribute_groups.show')->with('attributeGroup', $attributeGroup);
    }

    /**
     * Show the form for editing the specified AttributeGroup.
     *
     * @param AttributeGroup $attributeGroup
     * @return Response
     */
    public function edit(AttributeGroup $attributeGroup)
    {
        return view('admin.attribute_groups.edit')->with('attributeGroup', $attributeGroup);
    }

    /**
     * Update the specified AttributeGroup in storage.
     *
     * @param AttributeGroup $attributeGroup
     * @param UpdateAttributeGroupRequest $request
     *
     * @return Response
     */
    public function update(AttributeGroup $attributeGroup, UpdateAttributeGroupRequest $request)
    {
        $input = AttributeGroupRepository::requestHandler($request);

        $this->attributeGroupRepository->update($input, $attributeGroup->id);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Attribute Group updated successfully.');

        return Response::json(['message' => 'Attribute Group has been updated successfully.',
            'back_url' => route('admin.attribute-groups.index')]);
    }

    /**
     * Remove the specified AttributeGroup from storage.
     *
     * @param AttributeGroup $attributeGroup
     * @return Response
     */
    public function destroy(AttributeGroup $attributeGroup)
    {
        $this->attributeGroupRepository->delete($attributeGroup->id);

        return Response::json(['message' => 'Attribute Group deleted successfully']);
    }

    /**
     * Change status of the specified AttributeGroup.
     *
     * @param AttributeGroup $attributeGroup
     * @return Response
     */
    public function statusChange(AttributeGroup $attributeGroup)
    {
        $attributeGroup->status = !$attributeGroup->status;
        $attributeGroup->save();

        return Response::json(['message' => 'Attribute Group status updated successfully']);
    }
}
