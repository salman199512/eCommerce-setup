<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\WebsiteDataTable;
use App\Http\Requests\Admin\Website\CreateRequest;
use App\Http\Requests\Admin\Website\UpdateRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Admin\WebsiteRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use App\MyClasses\GeneralHelperFunctions;
use App\Models\Website;
use Illuminate\Support\Facades\DB;
use Response;

class WebsiteController extends AppBaseController
{
    /** @var WebsiteRepository $websiteRepository*/
    private $websiteRepository;

    public function __construct(WebsiteRepository $websiteRepo)
    {
        $this->websiteRepository = $websiteRepo;
    }

    /**
     * Display a listing of the Website.
     *
     * @param WebsiteDataTable $websiteDataTable
     * @return Response
     */
    public function index(WebsiteDataTable $websiteDataTable) {
        return $websiteDataTable->render('admin.websites.index');
    }


    /**
     * Show the form for creating a new Website.
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application|void
     */
    public function create() {
        return view('admin.websites.create');
    }

    /**
     * Store a newly created Website in storage.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function store(CreateRequest $request) {
        DB::beginTransaction();
        $website = Website::create($request->validated());
        if(isset($request->avatar) && $request->avatar != ''){
            $this->websiteRepository->updateOrCreate_avatar($website,$request);
        }
        DB::commit();
        session()->flash('alert-type', 'success');
        session()->flash('message', 'Website has been created successfully!');
        return Response::json(['message' => 'Website has been created successfully.', 'back_url' => route('admin.websites.index')]);
    }

    /**
     * Display the specified Website.
     *
     * @param Website $website
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application|void
     */
    public function show(Website $website) {
        return view('admin.websites.show')->with('website', $website);
    }

    /**
     * Show the form for editing the specified Website.
     *
     * @param Website $website
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application|void
     */
    public function edit(Website $website) {
        return view('admin.websites.edit')->with('website', $website);
    }

    /**
     * Update the specified Website in storage.
     *
     * @param Website $website
     * @param UpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(Website $website, UpdateRequest $request) {
        DB::beginTransaction();
        $website->update($request->validated());
        if(isset($request->avatar) && $request->avatar != ''){
            $this->websiteRepository->updateOrCreate_avatar($website,$request);
        }
        DB::commit();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Website has been updated successfully!');
        return Response::json(['message' => 'Website updated successfully.', 'back_url' => route('admin.websites.index')]);
    }


/**
     * Remove the specified Website from storage.
     *
     * @param Website $website
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Website $website) {
        $website->delete();

        return Response::json(['message' => 'Website deleted successfully']);
    }
}
