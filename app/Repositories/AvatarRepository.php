<?php namespace App\Repositories;

use App\Models\Avatars;
use App\Interfaces\AvatarRepositoryInterface;
use App\Traits\ResponseAPI;


class AvatarRepository implements AvatarRepositoryInterface
{

    // Use ResponseAPI Trait in this repository
    use ResponseAPI;
    /* **************************SHOW Answer ********************** */

    public function index()
    {
        try{
        $avatars=Avatars::all();
        return $this->success("Avatars affichées", $avatars);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        } 
    }
}