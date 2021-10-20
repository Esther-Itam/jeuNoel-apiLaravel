<?php namespace App\Repositories;

use App\Interfaces\QuizRepositoryInterface;
use App\Traits\ResponseAPI;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Quiz;
use Illuminate\Support\Facades\DB;


class QuizRepository implements QuizRepositoryInterface
{
    // Use ResponseAPI Trait in this repository
    use ResponseAPI;

    /* **************************INDEX QUIZ ********************** */
    public function index()
    {
        try{
            $quiz = Quiz::all(); 
            return $this->success("quizzes affichés", $quiz);
        }catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }    
    }

    /* **************************SHOW QUIZ ********************** */
    public function show($id)
    {
        try{
            $quiz=Quiz::find($id);
            $quiz = DB::table('quizzes')->select('quizzes.name as quizName', 'quizzes.id as quizId')
            ->join('categories', 'categories.id', '=', 'quizzes.categorie_id')
            ->where('quizzes.id', '=', $id)
            ->get();

            $row2[]=$quiz;

            $questions = DB::table('questions')->select('questions.name as questionName', 'questions.id as questionId')
                                                ->join('quizzes', 'quizzes.id', '=', 'questions.quiz_id')
                                                ->where('quizzes.id', '=', $id)
                                                ->get();

            $row3[]=$questions;

            $answers = DB::table('answers')->select('answers.name as answerName', 'answers.id as answerId', 'answers.is_valid as answerValid')
                                            ->join('questions', 'questions.id', '=', 'answers.question_id')
                                            ->join('quizzes', 'quizzes.id', '=', 'questions.quiz_id')
                                            ->where('quizzes.id', '=', $id)
                                            ->get();
        
            $row4[]=$answers;
            $data=Arr::crossJoin($row2, $row3, $row4);
            return $this->success("quizzes affichés", $data);
        }catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }   
    }
 
    /* **************************CREATE QUIZ ********************** */
    public function store(Request $request)
    {
        try{
            $quiz = new Quiz;  
            $quiz->name = $request->input('name');  
            $quiz->categorie_id =$request->input('categorie');   
            $quiz->save();  
            return $this->success("creation du quiz reussi", $quiz);
        }catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }       
    }

    /* **************************UPDATE QUIZ ********************** */
    public function update(Request $request, $id)
    {
        try{
            $quiz = Quiz::findOrFail($id);
            $quiz->update($request->all());
            return $this->success("mise a jour du quiz reussie", $quiz);
        }catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }  
    }

    /* **************************DELETE QUIZ ********************** */
    public function delete(Request $request, $id)
    {
        try{
            $quiz = Quiz::findOrFail($id);
            $quiz->delete();
            return $this->success("Quiz supprimé", $quiz);
        }catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}