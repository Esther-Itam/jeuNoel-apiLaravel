<?php namespace App\Repositories;

use App\Models\Answers;
use App\Interfaces\AnswerRepositoryInterface;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnswerRepository implements AnswerRepositoryInterface
{

    // Use ResponseAPI Trait in this repository
    use ResponseAPI;
    /* **************************SHOW Answer ********************** */
	public function index()
    {
		try {
            $answer = Answers::all();
            return $this->success("Réponses affichées", $answer);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }  
	}

    /* **************************CREATE Answer ********************** */
    public function store(Request $request)
    {
        $id = DB::table('questions')->orderBy('id', 'DESC')->value('id');

        try{
            $answer = new Answers;
            $answer->name = $request->input('answer'); 
            $answer->question_id = $id;
            $answer->is_valid = $request->input('is_valid');
            $answer->save();  
            return $this->success("creation de la réponse reussi", $answer);        
             
        }catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }  
         
    }

    /* **************************UPDATE Answer ********************** */
    public function update(Request $request, $id)
    {
        $answer = Answers::findOrFail($id);
        $answer->update($request->all());
        return $this->success("mise a jour de la réponse reussie", $answer); 
    }
}