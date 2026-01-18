<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ContentManagementDataTable;
use App\Http\Requests\Admin\ContentManagement\CreateRequest;
use App\Http\Requests\Admin\ContentManagement\UpdateRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Blog;
use App\Repositories\Admin\ContentManagementRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use App\MyClasses\GeneralHelperFunctions;
use App\Models\ContentManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class ContentManagementController extends AppBaseController
{
    /** @var ContentManagementRepository $contentManagementRepository*/
    private $contentManagementRepository;

    public function __construct(ContentManagementRepository $contentManagementRepo)
    {
        $this->contentManagementRepository = $contentManagementRepo;
    }

    /**
     * Display a listing of the ContentManagement.
     *
     * @param ContentManagementDataTable $contentManagementDataTable
     * @return Response
     */
    public function index(ContentManagementDataTable $contentManagementDataTable) {
        return $contentManagementDataTable->render('admin.content_managements.index');
    }


    /**
     * Show the form for creating a new ContentManagement.
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application|void
     */
    public function create() {
        return view('admin.content_managements.create');
    }

    /**
     * Store a newly created ContentManagement in storage.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function store(CreateRequest $request) {
        DB::beginTransaction();
        $input = $request->validated();
        $contentManagement = ContentManagement::create($input);
        DB::commit();
        session()->flash('alert-type', 'success');
        session()->flash('message', 'ContentManagement has been created successfully!');
        return Response::json(['message' => 'ContentManagement has been created successfully.', 'back_url' => route('admin.contentManagements.index')]);
    }

    /**
     * Display the specified ContentManagement.
     *
     * @param ContentManagement $contentManagement
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application|void
     */
    public function show(ContentManagement $contentManagement) {
        return view('admin.content_managements.show')->with('contentManagement', $contentManagement);
    }

    /**
     * Show the form for editing the specified ContentManagement.
     *
     * @param ContentManagement $contentManagement
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application|void
     */
    public function edit(ContentManagement $contentManagement) {
        return view('admin.content_managements.edit')->with('contentManagement', $contentManagement);
    }

    /**
     * Update the specified ContentManagement in storage.
     *
     * @param ContentManagement $contentManagement
     * @param UpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(ContentManagement $contentManagement, UpdateRequest $request) {
        DB::beginTransaction();
        $input = $request->validated();
        $contentManagement->update($input);
        DB::commit();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'ContentManagement has been updated successfully!');
        return Response::json(['message' => 'ContentManagement updated successfully.', 'back_url' => route('admin.contentManagements.index')]);
    }


/**
     * Remove the specified ContentManagement from storage.
     *
     * @param ContentManagement $contentManagement
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(ContentManagement $contentManagement) {
        $contentManagement->delete();

        return Response::json(['message' => 'ContentManagement deleted successfully']);
    }

    public function statusChange($id, Request $request)
    {
        $input = $request->all();
        $update = ContentManagement::where('uuid', $id)->first();
        $update->active = $input['active'];
        $update->save();
        return Response::json(['message' => 'Status Updated Successfully']);
    }
}
