<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateAdminRequest;
use App\Http\Requests\Admin\DeleteRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Http\Requests\Admin\UpdateStatusRequest;
use App\Repositories\AdminsRepository;
use App\Repositories\Spatie\RoleRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminsController extends Controller
{
    public function __construct(AdminsRepository $adminsRepo, RoleRepository $roleRepo)
    {
        $this->adminsRepo = $adminsRepo;
        $this->roleRepo = $roleRepo;
    }

    public function index()
    {
        $roles = $this->roleRepo->getAll()->pluck('name','name')->all();
        return view('admin.pages.admins.index',compact('roles'));
    }

    public function show(Request $request)
    {
        $admin = $this->adminsRepo->getOneAdmin($request->uuid);
        $adminRole = $admin->roles->pluck('name','name')->all();
        return response([
            'admin' => $admin,
            'adminRole' => $adminRole,
        ],200);
    }


    public function getAll()
    {
        $admins = $this->adminsRepo
            ->getAll()
            ->latest()
            ->get();
        $user = auth()->guard('admin')->user();
        return DataTables::of($admins)
            ->addColumn('actions', function($row) use ($user){
                $btn = '<div class="action-btns">';
                if($user->can('edit_admin')) {
                    $btn = $btn.
                    '<a data-id="'.$row->uuid.'" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="'.__('dashboard.edit').'" data-bs-original-title="تعديل">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                        </a>';
                }
                if($user->can('delete_admin')) {
                    $btn = $btn.
                    '<a data-id="'.$row->uuid.'" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="'.__('dashboard.delete').'" data-bs-original-title="حذف">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                        </a>';
                }
                $btn = $btn.'</div>';

                return $btn;
            })
            ->addColumn('last_login', function($row) {
               return $row?->last_login?->format('Y-m-d H:i');
            })
            ->addColumn('roles', function($row) {
                $roles = '';
                if (!empty($row->getRoleNames()))
                {
                    foreach ($row->getRoleNames() as $role) {
                        $roles = '<div class="badge bg-success rounded px-3 py-1">'.$role.'</div> ' . $roles;
                    }
                    return $roles;
                }
            })
            ->addColumn('active', function($row) use ($user) {
                if ($row->active)
                {
                    if($user->can('edit_admin')) {
                        return
                            '<a class="changeStatus" data-id="'.$row->uuid.'" data-active="1" title="'.__('dashboard.press_deactivate').'">
                                <div class="badge badge-light-success mb-2 me-4"> '.$row->status.'</div>
                            </a>';
                    }
                }else{
                    if($user->can('edit_admin')) {
                        return
                            '<a class="changeStatus" data-id="' . $row->uuid . '" data-active="0" title="' . __('dashboard.press_activate') . '">
                                <div class="badge badge-light-danger mb-2 me-4"> ' . $row->status . '</div>
                            </a>';
                    }
                }
            })
            ->rawColumns([
                'full_name'
                ,'roles'
                ,'phone'
                ,'email'
                ,'last_login'
                ,'active'
                ,'actions'
            ])
            ->make(true);
    }


    public function store(CreateAdminRequest $request)
    {
        $this->adminsRepo->store($request->validated());
        return response([
            'message' => __('apiMessages.admins.created'),
        ],200);
    }


    public function update(UpdateAdminRequest $request)
    {
        $this->adminsRepo->update($request->validated());
        return response([
            'message' => __('apiMessages.admins.updated'),
        ],200);
    }

    public function changeStatus(UpdateStatusRequest $request)
    {
        $this->adminsRepo->updateStatus($request->validated());
        return response([
            'message' => __('apiMessages.admins.statusUpdated'),
        ],200);
    }


    public function delete(DeleteRequest $request)
    {
        $this->adminsRepo->delete($request->validated());
        return response([
            'message' => __('apiMessages.admins.deleted'),
        ],200);
    }
}
