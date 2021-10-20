<?php namespace App\Http\Controllers;

use App\Interfaces\ResultRepositoryInterface; 

class ResultController extends Controller
{

  protected $resultInterface;

  public function __construct(ResultRepositoryInterface $resultInterface)
  {
      $this->resultInterface = $resultInterface;
  }
  
  /* **************************INDEX RESULTS ********************** */
  function index()
  {
    return $this->resultInterface->index();
  }
}