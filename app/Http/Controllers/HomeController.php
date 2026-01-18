<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Models\CartProduct;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Artisan;
use App\Models\ContentManagement;
use App\Models\Faq;
use App\Models\NewsLetter;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Product;
use App\Models\Rashifal;
use App\Models\RashifalDetail;
use App\Models\RashifalDetailRashi;
use App\Models\Tag;
use App\Models\Video;
use App\Models\Website;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use App\MyClasses\GeneralHelperFunctions;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Response;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class HomeController extends AppBaseController
{


    public function index()
    {
        $Our_Vision = Website::where('type', 'Our_Vision')->get();

        $seo = array(
            'meta_title' => GeneralHelperFunctions::getSetting('meta_title'),
            'meta_description' => GeneralHelperFunctions::getSetting('meta_description'),
            'meta_keyword' => GeneralHelperFunctions::getSetting('meta_keyword'),
        );

        $return_data['seo'] = $seo;
        $return_data['Our_Vision'] = $Our_Vision;


        return view('frontend.home.index', $return_data);
    }


    public function cmsDetail($slug)
    {
        $cms_detail = ContentManagement::where('slug', $slug)->first();

        if (!empty($cms_detail)) {
            $seo = array(
                'meta_title' => $cms_detail->meta_title ?? '',
                'meta_description' => $cms_detail->meta_description ?? '',
                'meta_keyword' => $cms_detail->meta_keyword ?? '',
            );
            return view('frontend.cms.index', compact('cms_detail', 'seo'));
        } else {
            return redirect()->back();
        }
    }

    public function faqs()
    {
        $faqs = Faq::all();
        $seo = array(
            'meta_title' => 'Frequently Asked Questions - Ramdev Oil' ?? '',
            'meta_description' => "Have questions? Explore our FAQ page to find answers to the most commonly asked questions about My News website, including how to navigate the site, subscribe, access content, and more. We're here to help!" ?? '',
            'meta_keyword' => 'FAQ, frequently asked questions, My News FAQ, news website help, site navigation, subscription help, content access, My News questions, customer support, help center' ?? '',
        );
        return view('frontend.faqs.index', compact('faqs', 'seo'));
    }

    public function saveNewsLetter(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        $save = new NewsLetter();
        $save->email = $request->email;
        $save->save();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Thanks for subscribing! You will receive the latest updates.');


        return Response::json(['message' => 'Thanks for subscribing! You will receive the latest updates.',
            'back_url' => url()->previous(),
        ]);


    }

    public function saveInquiry(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $save = new Inquiry();
        $save->name = $request->name;
        $save->email = $request->email;
        $save->phone = $request->phone;
        $save->subject = $request->subject;
        $save->message = $request->message;
        $save->save();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Inquiry Submitted successfully!');


        return Response::json([
            'message' => 'Inquiry Submitted successfully!',
            'back_url' => route('contact-us'),
        ]);


    }


    public function contact()
    {
        $seo = array(
            'meta_title' => 'Contact Us - Ramdev Oil' ?? '',
            'meta_description' => "Contact Us - Ramdev Oil" ?? '',
            'meta_keyword' => 'Contact Us - Ramdev Oil' ?? '',
        );
        return view('frontend.contact_us.index', compact('seo'));
    }

    public function about_us()
    {
        $seo = array(
            'meta_title' => 'About Us - Ramdev Oil' ?? '',
            'meta_description' => "About Us  - Ramdev Oil" ?? '',
            'meta_keyword' => 'About Us  - Ramdev Oil' ?? '',
        );
        $about_us = Website::where('type', 'About_Us')->first();
        $vision = Website::where('type', 'Our_Vision')->first();
        $missions = Website::where('type', 'Our_Mission')->first();

        return view('frontend.about_us.index', compact('seo',
            'about_us',
            'vision',
            'missions',
        ));
    }





}
