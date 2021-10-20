<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\TeamAnswerRepositoryInterface; 

class TeamAnswersController extends Controller
{
  
  protected $teamAnswerInterface;

  public function __construct(TeamAnswerRepositoryInterface $teamAnswerInterface)
  {
      $this->teamAnswerInterface = $teamAnswerInterface;
  }

  /* **************************INDEX TEAM ANSWERS ********************** */
  public function index()
  {
    return $this->teamAnswerInterface->index();
  }

   /* **************************SHOW TEAM ANSWERS ********************** */
  public function show()
  { 
    return $this->teamAnswerInterface->show();
  }
    
 /* **************************SHOW ANSWERS ********************** */
  public function showAnswers()
  { 
    return $this->teamAnswerInterface->showAnswers();
  }

  /* **************************CREATE TEAM ANSWERS ********************** */
  public function store(Request $request)
  {
    return $this->teamAnswerInterface->store($request);
  }

  /* **************************DELETE Teams ********************** */
  public function delete()
  {
      return $this->teamAnswerInterface->delete();
  }

}