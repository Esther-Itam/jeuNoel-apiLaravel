<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\AnswerRepositoryInterface; 

class AnswerController extends Controller
{

  protected $answerInterface;

  public function __construct(AnswerRepositoryInterface $answerInterface)
  {
      $this->answerInterface = $answerInterface;
  }

  /* **************************SHOW Answer ********************** */
  public function index()
  {
    return $this->answerInterface->index();
  }

  /* **************************STORE Answer ********************** */
  public function store(Request $request)
  {
    return $this->answerInterface->store($request); 
  }

  /* **************************UPDATE Answer ********************** */

  public function update(Request $request, $id)
  {
    return $this->answerInterface->update($request, $id);
  }
   
}
