<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\QuestionRepositoryInterface; 

class QuestionController extends Controller
{

    protected $questionInterface;

    public function __construct(QuestionRepositoryInterface $questionInterface)
    {
        $this->questionInterface = $questionInterface;
    }
    
    /* **************************SHOW Answer ********************** */
    public function index()
    {
        return $this->questionInterface->index();
    }
  
    /* **************************STORE Answer ********************** */
    public function store(Request $request)
    {
      return $this->questionInterface->store($request); 
    }
  
    /* **************************UPDATE Answer ********************** */
    public function update(Request $request, $id)
    {
      return $this->questionInterface->update($request, $id);
    }
}
