<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\TestimonialDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Admin\CreateTestimonialRequest;
use App\Http\Requests\Admin\UpdateTestimonialRequest;
use App\Models\Testimonial;
use App\Repositories\Admin\TestimonialRepository;
use Illuminate\Http\Request;
use Response;

class TestimonialController extends AppBaseController
{
    /** @var TestimonialRepository */
    private $testimonialRepository;

    public function __construct(TestimonialRepository $testimonialRepo)
    {
        $this->testimonialRepository = $testimonialRepo;
    }

    /**
     * Display a listing of the Testimonial.
     *
     * @param TestimonialDataTable $testimonialDataTable
     * @return Response
     */
    public function index(TestimonialDataTable $testimonialDataTable)
    {
        return $testimonialDataTable->render('admin.testimonials.index');
    }

    /**
     * Show the form for creating a new Testimonial.
     *
     * @return Response
     */
    public function create()
    {
        $type = 'create';
        return view('admin.testimonials.create', compact('type'));
    }

    /**
     * Store a newly created Testimonial in storage.
     *
     * @param CreateTestimonialRequest $request
     *
     * @return Response
     */
    public function store(CreateTestimonialRequest $request)
    {
        $input = $request->all();
        $input['status'] = $request->has('status') ? 1 : 0;

        $testimonial = $this->testimonialRepository->create($input);

        if ($request->hasFile('image')) {
            $testimonial->addMediaFromRequest('image')->toMediaCollection('testimonial_avatars');
        }

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Testimonial saved successfully.');
        return Response::json(['message' => 'Testimonial has been created successfully.',
            'back_url' => route('admin.testimonials.index')]);
    }

    /**
     * Show the form for editing the specified Testimonial.
     *
     * @param Testimonial $testimonial
     * @return Response
     */
    public function edit(Testimonial $testimonial)
    {
        $type = 'edit';
        return view('admin.testimonials.edit', compact('testimonial', 'type'));
    }

    /**
     * Update the specified Testimonial in storage.
     *
     * @param Testimonial $testimonial
     * @param UpdateTestimonialRequest $request
     *
     * @return Response
     */
    public function update(Testimonial $testimonial, UpdateTestimonialRequest $request)
    {
        $input = $request->all();
        $input['status'] = $request->has('status') ? 1 : 0;

        $this->testimonialRepository->update($input, $testimonial->id);

        if ($request->hasFile('image')) {
            $testimonial->clearMediaCollection('testimonial_avatars');
            $testimonial->addMediaFromRequest('image')->toMediaCollection('testimonial_avatars');
        }

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Testimonial updated successfully.');

        return Response::json(['message' => 'Testimonial has been updated successfully.',
            'back_url' => route('admin.testimonials.index')]);
    }

    /**
     * Remove the specified Testimonial from storage.
     *
     * @param Testimonial $testimonial
     * @return Response
     */
    public function destroy(Testimonial $testimonial)
    {
        $this->testimonialRepository->delete($testimonial->id);

        return Response::json(['message' => 'Testimonial deleted successfully']);
    }

    /**
     * Change status of the specified Testimonial.
     *
     * @param Testimonial $testimonial
     * @return Response
     */
    public function statusChange(Testimonial $testimonial)
    {
        $testimonial->status = !$testimonial->status;
        $testimonial->save();

        return Response::json(['message' => 'Testimonial status updated successfully']);
    }
}
