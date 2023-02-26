<?php

namespace App\Repositories;
use App\Models\Aboutus;
use App\Models\Category;
use App\Models\Supporter;
use Illuminate\Support\Arr;

class CategoryRepository
{
    public function __construct(Category $repo)
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
            "content"=>Arr::get($data,'content'),
            "type"=>Arr::get($data,'type'),
            "video_link"=>Arr::get($data,'video_link'),
        ]);
        if (!is_null($file = Arr::get($data, 'image_link'))) {
            $about->addMedia($file)
                ->preservingOriginal()
                ->toMediaCollection('category_images');
        }
        return $about;
    }
    public function udpate(array $data){
        $about_record = $this->repo->find(Arr::get($data,'id'));
        $about = $about_record->update([
            "title"=>Arr::get($data,'title'),
            "content"=>Arr::get($data,'content'),
            "type"=>Arr::get($data,'type'),
            "video_link"=>Arr::get($data,'video_link'),
        ]);
        if (!is_null($file = Arr::pull($data, 'image_link', null))) {
            $about_record->clearMediaCollection('category_images');
            $about_record->addMedia($file)
                ->preservingOriginal()
                ->toMediaCollection('category_images');
        }
        return $about;
    }
}
