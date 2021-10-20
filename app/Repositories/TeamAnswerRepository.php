<?php namespace App\Repositories;

use App\Interfaces\TeamAnswerRepositoryInterface;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use App\Models\Team_answers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TeamAnswerRepository implements TeamAnswerRepositoryInterface
{
    // Use ResponseAPI Trait in this repository
    use ResponseAPI;

    /* **************************CREATE TEAM ANSWERS ********************** */
    public function store(Request $request)
    {
        try{
            $teamAnswers= new Team_answers;
            $teamAnswers->question_id=$request->input('question_id');  
            $teamAnswers->team_id=$request->input('team_id'); 
            $teamAnswers->answer_id=$request->input('answer_id'); 
            $teamAnswers->save();  
            return $this->success("Réponse envoyée", $teamAnswers);
        }catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }           
    }

    /* **************************INDEX TEAM ANSWERS ********************** */
    public function index()
    {
        try{
            $teamAnswers = Team_answers::all();
            return $this->success("Réponses validées", $teamAnswers);
        }catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }     
    }

    /* **************************SHOW TEAM ANSWERS ********************** */
    public function show()
    { 
        try{
            $data = DB::table('team_answers')
            ->join('questions', 'questions.id', '=', 'team_answers.question_id')
            ->join('answers', 'answers.id', '=', 'team_answers.answer_id')
            ->where('answers.is_valid', '=', 1)
            ->whereNotNull('team_answers.id')
            ->whereTime('team_answers.created_at', '<', Carbon::now()->subMinutes(3)->toDateTimeString())
            ->get();
            return $this->success("Nombre de réponses justes", $data);
        }catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }   
    }


    /* **************************SHOW ANSWERS ********************** */
    public function showAnswers()
    { 
        try{
            $data = DB::table('questions')
            ->join('team_answers', 'questions.id', '=', 'team_answers.question_id')
            ->join('answers', 'answers.question_id', '=', 'questions.id')
            ->where('answers.is_valid', '=', 1)
            ->whereNotNull('team_answers.id')
            ->whereTime('team_answers.created_at', '<', Carbon::now()->subMinutes(3)->toDateTimeString())
            ->select('questions.name as questionName', 'answers.name as answerName', 'answers.id as answerId', 'team_answers.answer_id as team_answerId')
            ->get();
            return $this->success("Réponses validées affichées", $data);
        }catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }   
    }

    /* **************************DELETE Teams ********************** */
    public function delete()
    {
        try{
            $teamAnswers=DB::table('team_answers')->delete();
            return $this->success("Réponses des équipes supprimées", $teamAnswers);
        }catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    } 
}