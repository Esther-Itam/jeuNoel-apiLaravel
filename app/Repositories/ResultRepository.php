<?php namespace App\Repositories;

use App\Interfaces\ResultRepositoryInterface;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use App\Models\Team_answers;
use Illuminate\Support\Facades\DB;
use App\Events\ResultEvent;

class ResultRepository implements ResultRepositoryInterface
{
    // Use ResponseAPI Trait in this repository
    use ResponseAPI;

    /* **************************INDEX RESULTS ********************** */
    public function index()
    {
        try{
            $team_answers = DB::table('team_answers')
            ->join('teams', 'teams.id', '=', 'team_answers.team_id')
            ->join('answers', 'answers.id', '=', 'team_answers.answer_id')
            ->where('answers.is_valid', '=', 1)
            ->whereNotNull('team_answers.id')
            ->select('teams.name as teamName', DB::raw('count(team_answers.answer_id) as userCount'))
            ->groupBy('teams.name')
            ->orderByDesc('userCount')
            ->get();
            $data[]=$team_answers;
            event(new ResultEvent($team_answers));
            return $this->success("bilan affiché", $data);
        }catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }  
}