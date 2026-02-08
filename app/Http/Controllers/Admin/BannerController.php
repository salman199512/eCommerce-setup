<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\BannerDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Admin\CreateBannerRequest;
use App\Http\Requests\Admin\UpdateBannerRequest;
use App\Models\Banner;
use App\Repositories\Admin\BannerRepository;
use Illuminate\Http\Request;
use Response;

class BannerController extends AppBaseController
{
    /** @var BannerRepository */
    private $bannerRepository;

    public function __construct(BannerRepository $bannerRepo)
    {
        $this->bannerRepository = $bannerRepo;
    }

    /**
     * Display a listing of the Banner.
     *
     * @param BannerDataTable $bannerDataTable
     * @return Response
     */
    public function index(BannerDataTable $bannerDataTable)
    {
        return $bannerDataTable->render('admin.banners.index');
    }

    /**
     * Show the form for creating a new Banner.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created Banner in storage.
     *
     * @param CreateBannerRequest $request
     *
     * @return Response
     */
    public function store(CreateBannerRequest $request)
    {
        $input = BannerRepository::requestHandler($request);

        $banner = $this->bannerRepository->create($input);

        if ($request->hasFile('image')) {
            $banner->addMediaFromRequest('image')->toMediaCollection('banner_images');
        }

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Banner saved successfully.');
        return Response::json(['message' => 'Banner has been created successfully.',
            'back_url' => route('admin.banners.index')]);
    }

    /**
     * Show the form for editing the specified Banner.
     *
     * @param Banner $banner
     * @return Response
     */
    public function edit(Banner $banner)
    {
        return view('admin.banners.edit')->with('banner', $banner);
    }

    /**
     * Update the specified Banner in storage.
     *
     * @param Banner $banner
     * @param UpdateBannerRequest $request
     *
     * @return Response
     */
    public function update(Banner $banner, UpdateBannerRequest $request)
    {
        $input = BannerRepository::requestHandler($request);

        $this->bannerRepository->update($input, $banner->id);

        if ($request->hasFile('image')) {
            $banner->clearMediaCollection('banner_images');
            $banner->addMediaFromRequest('image')->toMediaCollection('banner_images');
        }

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Banner updated successfully.');

        return Response::json(['message' => 'Banner has been updated successfully.',
            'back_url' => route('admin.banners.index')]);
    }

    /**
     * Remove the specified Banner from storage.
     *
     * @param Banner $banner
     * @return Response
     */
    public function destroy(Banner $banner)
    {
        $this->bannerRepository->delete($banner->id);

        return Response::json(['message' => 'Banner deleted successfully']);
    }

    /**
     * Change status of the specified Banner.
     *
     * @param Banner $banner
     * @return Response
     */
    public function statusChange(Banner $banner)
    {
        $banner->status = !$banner->status;
        $banner->save();

        return Response::json(['message' => 'Banner status updated successfully']);
    }
}
