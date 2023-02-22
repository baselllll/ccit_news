<?php

namespace App\Repositories;
use App\Models\Contactus;

class ContactRepository
{
    public function __construct(Contactus $repo)
    {
        $this->repo = $repo;
    }

    public function getAll(){
        return $this->repo->orderBy('id','DESC');
    }

    public function delete($id)
    {
        $contact = $this->repo->findOrFail($id);
        $contact->delete();
        return $contact;
    }
}
