<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\FaqDataTable;
use App\Http\Requests\Admin\Faq\CreateRequest;
use App\Http\Requests\Admin\Faq\UpdateRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Admin\FaqRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use App\MyClasses\GeneralHelperFunctions;
use App\Models\Faq;
use Illuminate\Support\Facades\DB;
use Response;

class FaqController extends AppBaseController
{
    /** @var FaqRepository $faqRepository*/
    private $faqRepository;

    public function __construct(FaqRepository $faqRepo)
    {
        $this->faqRepository = $faqRepo;
    }

    /**
     * Display a listing of the Faq.
     *
     * @param FaqDataTable $faqDataTable
     * @return Response
     */
    public function index(FaqDataTable $faqDataTable) {
        return $faqDataTable->render('admin.faqs.index');
    }


    /**
     * Show the form for creating a new Faq.
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application|void
     */
    public function create() {
        return view('admin.faqs.create');
    }

    /**
     * Store a newly created Faq in storage.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function store(CreateRequest $request) {
        DB::beginTransaction();
        $faq = Faq::create($request->validated());
        DB::commit();
        session()->flash('alert-type', 'success');
        session()->flash('message', 'Faq has been created successfully!');
        return Response::json(['message' => 'Faq has been created successfully.', 'back_url' => route('admin.faqs.index')]);
    }

    /**
     * Display the specified Faq.
     *
     * @param Faq $faq
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application|void
     */
    public function show(Faq $faq) {
        return view('admin.faqs.show')->with('faq', $faq);
    }

    /**
     * Show the form for editing the specified Faq.
     *
     * @param Faq $faq
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application|void
     */
    public function edit(Faq $faq) {
        return view('admin.faqs.edit')->with('faq', $faq);
    }

    /**
     * Update the specified Faq in storage.
     *
     * @param Faq $faq
     * @param UpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(Faq $faq, UpdateRequest $request) {
        DB::beginTransaction();
        $faq->update($request->validated());
        DB::commit();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Faq has been updated successfully!');
        return Response::json(['message' => 'Faq updated successfully.', 'back_url' => route('admin.faqs.index')]);
    }


/**
     * Remove the specified Faq from storage.
     *
     * @param Faq $faq
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Faq $faq) {
        $faq->delete();

        return Response::json(['message' => 'Faq deleted successfully']);
    }
}
