<?php namespace App\Repositories;

use App\Models\Questions;
use App\Interfaces\QuestionRepositoryInterface;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionRepository implements QuestionRepositoryInterface
{
    // Use ResponseAPI Trait in this repository
    use ResponseAPI;
        
    /* **************************SHOW Question ********************** */
    public function index()
    {
        try{
            $question = Questions::all(); 
            return $this->success("Questions affichées", $question);
        }catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }        
    }

    /* **************************STORE Question ********************** */
    public function store(Request $request)
    {
        $id = DB::table('quizzes')->orderBy('id', 'DESC')->value('id');

        try{
            $question= new Questions;
            $question->name = $request->input('question'); 
            $question->quiz_id=$id; 
            $question->save();  
            return $this->success("creation du question reussi", $question);
        }catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }        
    }

    /* **************************UPDATE Question ********************** */
    public function update(Request $request, $id)
    {
        try{
            $question = Questions::findOrFail($id);
            $question->update($request->all());
            return $this->success("mise a jour de la question reussie", $question);
        }catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        } 
    }          
}