<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\QuizRepositoryInterface; 


class QuizController extends Controller
{

    protected $quizInterface;

    public function __construct(QuizRepositoryInterface $quizInterface)
    {
        $this->quizInterface = $quizInterface;
    }

    /* **************************INDEX QUIZ ********************** */
    public function index()
    {
        return $this->quizInterface->index();   
    }

    /* **************************SHOW QUIZ ********************** */
    public function show($id)
    {
        return $this->quizInterface->show($id);   
    }

    /* **************************CREATE QUIZ ********************** */
    public function store(Request $request)
    {
        return $this->quizInterface->store($request);  
    }

    /* **************************UPDATE QUIZ ********************** */
    public function update(Request $request, $id)
    {
        return $this->quizInterface->update($request, $id);   
    }

    /* **************************DELETE QUIZ ********************** */
    public function delete(Request $request, $id)
    {
        return $this->quizInterface->delete($request, $id);    
    }
}