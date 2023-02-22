<?php
namespace App\Http\Controllers\Admin;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use App\Repositories\ContactRepository;
use App\Http\Requests\Contact\DeleteContactRequest;
use Illuminate\Http\Request;
class ContactUsController extends Controller
{
    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $contact_data = $this->repository->getAll()->latest()->get();
        return view('admin.pages.contact_us.index',compact('contact_data'));
    }

    public function delete($id){
        try {
            $this->repository->delete($id);
            return redirect()->back()->with('success', __('apiMessages.contact.deleted'));
        } catch (\Exception $e){
            return redirect()->back()->with('success', __('apiMessages.contact.error'));
        }
    }
}
