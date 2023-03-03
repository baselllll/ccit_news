<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Aboutus;
use App\Models\Category;
use App\Models\GeneralSetting;
use App\Models\Supporter;
use Illuminate\Support\Facades\DB;

class HomePageController extends Controller
{
    public  function index(){
        $category =  DB::table('categories')->select(['type','id'])->distinct()->get();
        $categories = Category::distinct('type')->with('media')->latest()->get();
        $all_categories_data = Category::with('media')->get();
        $supporters = Supporter::with('media')->get();
        $about = Aboutus::with('media')->limit(4)->get();
        $setting = GeneralSetting::with('media')->first();
        return view('front.index',compact('category','setting','categories','supporters','all_categories_data','about'));
    }
}
