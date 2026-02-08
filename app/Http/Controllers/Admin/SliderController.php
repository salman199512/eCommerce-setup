<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SliderDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Admin\CreateSliderRequest;
use App\Http\Requests\Admin\UpdateSliderRequest;
use App\Models\Slider;
use App\Repositories\Admin\SliderRepository;
use Illuminate\Http\Request;
use Response;

class SliderController extends AppBaseController
{
    /** @var SliderRepository */
    private $sliderRepository;

    public function __construct(SliderRepository $sliderRepo)
    {
        $this->sliderRepository = $sliderRepo;
    }

    /**
     * Display a listing of the Slider.
     *
     * @param SliderDataTable $sliderDataTable
     * @return Response
     */
    public function index(SliderDataTable $sliderDataTable)
    {
        return $sliderDataTable->render('admin.sliders.index');
    }

    /**
     * Show the form for creating a new Slider.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created Slider in storage.
     *
     * @param CreateSliderRequest $request
     *
     * @return Response
     */
    public function store(CreateSliderRequest $request)
    {
        $input = SliderRepository::requestHandler($request);

        $slider = $this->sliderRepository->create($input);

        if ($request->hasFile('image')) {
            $slider->addMediaFromRequest('image')->toMediaCollection('slider_images');
        }

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Slider saved successfully.');
        return Response::json(['message' => 'Slider has been created successfully.',
            'back_url' => route('admin.sliders.index')]);
    }

    /**
     * Show the form for editing the specified Slider.
     *
     * @param Slider $slider
     * @return Response
     */
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit')->with('slider', $slider);
    }

    /**
     * Update the specified Slider in storage.
     *
     * @param Slider $slider
     * @param UpdateSliderRequest $request
     *
     * @return Response
     */
    public function update(Slider $slider, UpdateSliderRequest $request)
    {
        $input = SliderRepository::requestHandler($request);

        $this->sliderRepository->update($input, $slider->id);

        if ($request->hasFile('image')) {
            $slider->clearMediaCollection('slider_images');
            $slider->addMediaFromRequest('image')->toMediaCollection('slider_images');
        }

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Slider updated successfully.');

        return Response::json(['message' => 'Slider has been updated successfully.',
            'back_url' => route('admin.sliders.index')]);
    }

    /**
     * Remove the specified Slider from storage.
     *
     * @param Slider $slider
     * @return Response
     */
    public function destroy(Slider $slider)
    {
        $this->sliderRepository->delete($slider->id);

        return Response::json(['message' => 'Slider deleted successfully']);
    }

    /**
     * Change status of the specified Slider.
     *
     * @param Slider $slider
     * @return Response
     */
    public function statusChange(Slider $slider)
    {
        $slider->status = !$slider->status;
        $slider->save();

        return Response::json(['message' => 'Slider status updated successfully']);
    }
}
