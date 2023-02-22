<?php

namespace App\Repositories\Spatie;

use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function getAll()
    {
        return $this->permission;
    }
}
