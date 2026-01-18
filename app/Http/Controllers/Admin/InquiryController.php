<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\InquiryDataTable;
use App\Http\Requests\Admin\Inquiry\CreateRequest;
use App\Http\Requests\Admin\Inquiry\UpdateRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Admin\InquiryRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use App\MyClasses\GeneralHelperFunctions;
use App\Models\Inquiry;
use Illuminate\Support\Facades\DB;
use Response;

class InquiryController extends AppBaseController
{
    /** @var InquiryRepository $inquiryRepository*/
    private $inquiryRepository;

    public function __construct(InquiryRepository $inquiryRepo)
    {
        $this->inquiryRepository = $inquiryRepo;
    }

    /**
     * Display a listing of the Inquiry.
     *
     * @param InquiryDataTable $inquiryDataTable
     * @return Response
     */
    public function index(InquiryDataTable $inquiryDataTable) {
        return $inquiryDataTable->render('admin.inquiries.index');
    }


    /**
     * Show the form for creating a new Inquiry.
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application|void
     */
    public function create() {
        return view('admin.inquiries.create');
    }

    /**
     * Store a newly created Inquiry in storage.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function store(CreateRequest $request) {
        DB::beginTransaction();
        $inquiry = Inquiry::create($request->validated());
        DB::commit();
        session()->flash('alert-type', 'success');
        session()->flash('message', 'Inquiry has been created successfully!');
        return Response::json(['message' => 'Inquiry has been created successfully.', 'back_url' => route('admin.inquiries.index')]);
    }

    /**
     * Display the specified Inquiry.
     *
     * @param Inquiry $inquiry
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application|void
     */
    public function show(Inquiry $inquiry) {
        return view('admin.inquiries.show')->with('inquiry', $inquiry);
    }

    /**
     * Show the form for editing the specified Inquiry.
     *
     * @param Inquiry $inquiry
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application|void
     */
    public function edit(Inquiry $inquiry) {
        return view('admin.inquiries.edit')->with('inquiry', $inquiry);
    }

    /**
     * Update the specified Inquiry in storage.
     *
     * @param Inquiry $inquiry
     * @param UpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(Inquiry $inquiry, UpdateRequest $request) {
        DB::beginTransaction();
        $inquiry->update($request->validated());
        DB::commit();
        session()->flash('alert-type', 'success');
        session()->flash('message', 'Inquiry has been updated successfully!');
        return Response::json(['message' => 'Inquiry updated successfully.', 'back_url' => route('admin.inquiries.index')]);
    }

    /**
     * Remove the specified Inquiry from storage.
     *
     * @param Inquiry $inquiry
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Inquiry $inquiry) {
        $inquiry->delete();

        return Response::json(['message' => 'Inquiry deleted successfully']);
    }
}
