<?php
namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\CreateCategoryRequest;
use App\Repositories\CategoryRepository;
use App\Http\Controllers\Controller;
class CategoryController extends Controller
{
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $category_data = $this->repository->getAll()->with('media')->get();
        return view('admin.pages.category.index',compact('category_data'));
    }

    public function delete($id){
        try {
            $this->repository->delete($id);
            return redirect()->back()->with('success', __('apiMessages.support.deleted'));
        } catch (\Exception $e){
            return redirect()->back()->with('success', __('apiMessages.support.error'));
        }
    }

    public function store(CreateCategoryRequest $request){
        try {
            $this->repository->store($request->all());
            return redirect()->back()->with('success', __('apiMessages.support.added'));
        } catch (\Exception $e){
            return redirect()->back()->with('success', __('apiMessages.support.error'));
        }
    }
    public function update(CreateCategoryRequest $request){
        try {
            $this->repository->udpate($request->all());
            return redirect()->back()->with('success', __('apiMessages.support.updated'));
        } catch (\Exception $e){
            return redirect()->back()->with('success', __('apiMessages.support.error'));
        }
    }
}
