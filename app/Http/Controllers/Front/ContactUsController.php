<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contactus;


class ContactUsController extends Controller
{
    public  function store(\Illuminate\Http\Request $request){
        Contactus::create($request->all());
        return redirect()->back();
    }
}
