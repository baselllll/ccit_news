<?php

namespace App\Repositories;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminsRepository
{
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function getAll()
    {
        return $this->admin;
    }


    public function getOneAdmin($adminUUID)
    {
        return $this->admin->where('uuid',$adminUUID)->first();
    }

    public function store(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        DB::beginTransaction();
        try {
            $admin = $this->admin->create($data);
            $admin->assignRole($data['roles']);
            DB::commit();
        }catch (\Exception $exception){
            Log::error($exception);
            throw new \Exception($exception->getMessage());
        }
        return $admin;
    }

    public function update(array $data)
    {
        DB::beginTransaction();
        try {
            $admin = $this->admin->where('uuid',$data['uuid'])->first();
            $admin->update($data);
            DB::table('model_has_roles')->where('model_id', $admin->id)->delete();
            $admin->assignRole($data['roles']);
            DB::commit();
        }catch (\Exception $exception)
        {
            DB::rollback();
            Log::error($exception);
            throw new \Exception($exception->getMessage());
        }
        return $admin;
    }

    public function updateStatus(array $data)
    {
        DB::beginTransaction();
        try {
            $admin = $this->admin->where('uuid', $data['uuid']);
            $admin->update($data);
            DB::commit();
        }catch (\Exception $exception){
            Log::error($exception);
            throw new \Exception($exception->getMessage());
        }
        return $admin;
    }

    public function delete(array $data)
    {
        DB::beginTransaction();
        try {
            $admin = $this->admin->where('uuid',$data['uuid'])->first();
            $admin->roles()->detach();
            $admin->delete();
            DB::commit();
        } catch (\Exception $exception) {
            Log::error($exception);
            throw new \Exception($exception->getMessage());
        }
        return $admin;
    }
}
