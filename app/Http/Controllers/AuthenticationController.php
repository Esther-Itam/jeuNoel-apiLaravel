<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Validation\RegisterValidation;
use App\Http\Validation\UpdateValidation;
use App\Http\Validation\LoginValidation;
use App\Interfaces\UserRepositoryInterface;


class AuthenticationController extends Controller
{

    protected $userInterface;

    public function __construct(UserRepositoryInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    /* ***************************REGISTER *************************** */   
    public function register(Request $request, RegisterValidation $validation)
    {
        return $this->userInterface->register($request, $validation); 
    }

    /* ****************************UPDATE *************************** */
    public function update(Request $request, $id, UpdateValidation $validation)
    {
        return $this->userInterface->update($request, $id, $validation); 
    }

    /* ****************************LOGIN *************************** */
    public function login(Request $request, LoginValidation $validation)
    {
        return $this->userInterface->login($request, $validation); 
    }

    /* **************************INDEX User ********************** */

   function index()
   {
        return $this->userInterface->index();   
   }

    /* **************************SHOW User ********************** */
    public function show($id)
    {
        return $this->userInterface->show($id);   
    }
}
