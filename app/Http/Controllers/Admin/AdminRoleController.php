<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\DeleteRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Repositories\Spatie\PermissionRepository;
use App\Repositories\Spatie\RoleRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminRoleController extends Controller
{
    public function __construct(PermissionRepository $permissionRepo, RoleRepository $roleRepo)
    {
        $this->permissionRepo = $permissionRepo;
        $this->roleRepo = $roleRepo;
    }

    public function index()
    {
        $permissions = $this->permissionRepo
            ->getAll()
            ->where('guard_name','admin')
            ->get();
        return view('admin.pages.roles.index',compact('permissions'));
    }

    public function show(Request $request)
    {
        $role = $this->roleRepo->getOneRole($request->id);
        $rolePermissions = $this->roleRepo->getRolePermissions($request->id);
        return response([
            'role' => $role,
            'rolePermissions' => $rolePermissions,
        ],200);
    }


    public function getAll()
    {
        $roles = $this->roleRepo
            ->getAll()
            ->latest()
            ->get();
        $user = auth()->guard('admin')->user();
        return DataTables::of($roles)
            ->addColumn('actions', function($row) use ($user){
                $btn = '<div class="action-btns">';
                if($user->can('edit_role')) {
                    $btn = $btn.
                        '<a data-id="'.$row->id.'" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="'.__('dashboard.edit').'" data-bs-original-title="تعديل">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                        </a>';
                }
                if($user->can('delete_role')) {
                    $btn = $btn.
                        '<a data-id="'.$row->id.'" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="'.__('dashboard.delete').'" data-bs-original-title="حذف">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                        </a>';
                }
                $btn = $btn.'</div>';

                return $btn;
            })
            ->addColumn('name', function($row){
                return '<div class="badge bg-success rounded px-3 py-1">'.$row->name.'</div> ';
            })
            ->rawColumns([
                'name'
                ,'actions'
            ])
            ->make(true);
    }


    public function store(CreateRoleRequest $request)
    {
        $this->roleRepo->store($request->validated());
        return response([
            'message' => __('apiMessages.roles.created'),
        ],200);
    }


    public function update(UpdateRoleRequest $request)
    {
        $this->roleRepo->update($request->validated());
        return response([
            'message' => __('apiMessages.roles.updated'),
        ],200);
    }

    public function delete(DeleteRequest $request)
    {
        $this->roleRepo->delete($request->validated());
        return response([
            'message' => __('apiMessages.roles.deleted'),
        ],200);
    }
}
