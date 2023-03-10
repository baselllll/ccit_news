<?php

namespace App\Repositories;
use App\Models\Aboutus;
use Illuminate\Support\Arr;

class AboutUsRepository
{
    public function __construct(Aboutus $repo)
    {
        $this->repo = $repo;
    }

    public function getAll(){
        return $this->repo->orderBy('id','DESC');
    }

    public function delete($id)
    {
        $record = $this->repo->findOrFail($id);
        $record->delete();
        return $record;
    }
    public function store(array $data){
        $support = $this->repo->create([
            "title"=>Arr::get($data,'title'),
            "description"=>Arr::get($data,'description'),
            "name"=>Arr::get($data,'name'),
        ]);
        if (!is_null($file = Arr::get($data, 'image'))) {
            $support->addMedia($file)
                ->preservingOriginal()
                ->toMediaCollection('about_images');
        }
        return $support;
    }
    public function udpate(array $data){
        $support_record = $this->repo->find(Arr::get($data,'id'));
        $support = $support_record->update([
            "title"=>Arr::get($data,'title'),
            "description"=>Arr::get($data,'description')
        ]);
        if (!is_null($file = Arr::pull($data, 'image', null))) {
            $support_record->clearMediaCollection('about_images');
            $support_record->addMedia($file)
                ->preservingOriginal()
                ->toMediaCollection('about_images');
        }
        return $support;
    }
}
