<?php namespace App\Http\Controllers;

use App\Interfaces\AvatarRepositoryInterface; 


class AvatarController extends Controller
{
    
    protected $avatarInterface;

    public function __construct(AvatarRepositoryInterface $avatarInterface)
    {
        $this->avatarInterface = $avatarInterface;
    }

    /* **************************INDEX COLOR ********************** */
    public function index()
    {
        return $this->avatarInterface->index();
    }
   
}
