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
        $about = $this->repo->create([
            "title"=>Arr::get($data,'title'),
            "description"=>Arr::get($data,'description'),
        ]);
        if (!is_null($file = Arr::get($data, 'image'))) {
            $about->addMedia($file)
                ->preservingOriginal()
                ->toMediaCollection('about_images');
        }
        return $about;
    }
    public function udpate(array $data){
        $about_record = $this->repo->find(Arr::get($data,'id'));
        $about = $about_record->update([
            "title"=>Arr::get($data,'title'),
            "description"=>Arr::get($data,'description')
        ]);
        if (!is_null($file = Arr::pull($data, 'image', null))) {
            $about_record->clearMediaCollection('about_images');
            $about_record->addMedia($file)
                ->preservingOriginal()
                ->toMediaCollection('about_images');
        }
        return $about;
    }
}
