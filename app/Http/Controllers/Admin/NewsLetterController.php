<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\NewsLetterDataTable;
use App\Http\Controllers\AppBaseController;
use App\Models\ContentManagement;
use App\Repositories\Admin\FaqRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use App\MyClasses\GeneralHelperFunctions;
use App\Models\NewsLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class NewsLetterController extends AppBaseController
{


    public function __construct()
    {

    }


    public function index(NewsLetterDataTable $newsLetterDataTable) {
        return $newsLetterDataTable->render('admin.newsletters.index');
    }


}
