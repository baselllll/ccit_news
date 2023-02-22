<?php

namespace App\Repositories\Spatie;

use Spatie\Permission\Models\Role;
use DB;
class RoleRepository
{
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function getAll()
    {
        return $this->role->orderBy('id','DESC');
    }


    public function getOneRole(int $roleid)
    {
        return $this->role->findOrFail($roleid);
    }

    public function getRolePermissions(int $roleid)
    {
        return DB::table("role_has_permissions")->where("role_has_permissions.role_id",$roleid)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    }

    public function store(array $data)
    {
        $role = Role::create(['name' => $data['name']]);
        $role->syncPermissions($data['permissions']);
        return $role;
    }

    public function update(array $data)
    {
        $role = $this->role->findOrFail($data['id']);
        $role->update($data);
        $role->syncPermissions($data['permissions']);
        return $role;
    }
    public function delete(array $data)
    {
        $role = $this->role->findOrFail($data['id']);
        if ($role->users()->count() > 0 )
            throw new \Exception(__('customValidation.role.dependents'));

        $role->delete();
        return $role;
    }

}
