<?php
namespace App\Http\Controllers\Admin;
use App\Http\Requests\About\CreateAboutRequest;
use App\Http\Resources\Admin\AboutResource;
use App\Repositories\AboutUsRepository;
use Illuminate\Support\Arr;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use App\Repositories\ContactRepository;
use App\Http\Requests\Contact\DeleteContactRequest;
use Illuminate\Http\Request;
class AboutUsController extends Controller
{
    public function __construct(AboutUsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $about_data = $this->repository->getAll()->with('media')->get();
//        dd($about_data->first()->getMedia('about_images')->getUrl());
        return view('admin.pages.about_us.index',compact('about_data'));
    }

    public function delete($id){
        try {
            $this->repository->delete($id);
            return redirect()->back()->with('success', __('apiMessages.about.deleted'));
        } catch (\Exception $e){
            return redirect()->back()->with('success', __('apiMessages.about.error'));
        }
    }

    public function store(CreateAboutRequest $request){
        try {
            $this->repository->store($request->all());
            return redirect()->back()->with('success', __('apiMessages.about.added'));
        } catch (\Exception $e){
            return redirect()->back()->with('success', __('apiMessages.about.error'));
        }
    }
    public function update(CreateAboutRequest $request){
        try {
            $this->repository->udpate($request->all());
            return redirect()->back()->with('success', __('apiMessages.about.updated'));
        } catch (\Exception $e){
            return redirect()->back()->with('success', __('apiMessages.about.error'));
        }
    }
}
