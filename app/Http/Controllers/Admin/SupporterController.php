<?php
namespace App\Http\Controllers\Admin;
use App\Http\Requests\About\CreateAboutRequest;
use App\Http\Requests\Admin\CreateSupportRequest;
use App\Http\Resources\Admin\AboutResource;
use App\Repositories\AboutUsRepository;
use App\Repositories\SupporterRepository;
use Illuminate\Support\Arr;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use App\Repositories\ContactRepository;
use App\Http\Requests\Contact\DeleteContactRequest;
use Illuminate\Http\Request;
class SupporterController extends Controller
{
    public function __construct(SupporterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $support_data = $this->repository->getAll()->with('media')->get();
        return view('admin.pages.support.index',compact('support_data'));
    }

    public function delete($id){
        try {
            $this->repository->delete($id);
            return redirect()->back()->with('success', __('apiMessages.support.deleted'));
        } catch (\Exception $e){
            return redirect()->back()->with('success', __('apiMessages.support.error'));
        }
    }

    public function store(CreateSupportRequest $request){
        try {
            $this->repository->store($request->all());
            return redirect()->back()->with('success', __('apiMessages.support.added'));
        } catch (\Exception $e){
            return redirect()->back()->with('success', __('apiMessages.support.error'));
        }
    }
    public function update(CreateSupportRequest $request){
        try {
            $this->repository->udpate($request->all());
            return redirect()->back()->with('success', __('apiMessages.support.updated'));
        } catch (\Exception $e){
            return redirect()->back()->with('success', __('apiMessages.support.error'));
        }
    }
}
