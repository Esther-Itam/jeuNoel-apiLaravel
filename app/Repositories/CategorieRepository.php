<?php namespace App\Repositories;

use App\Interfaces\CategorieRepositoryInterface;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Categories;
use Illuminate\Support\Arr;
use App\Events\CategorieEvent;
use App\Events\QuizEvent;

class CategorieRepository implements CategorieRepositoryInterface
{

    // Use ResponseAPI Trait in this repository
    use ResponseAPI;

     /* **************************CREATE Categories ********************** */
    public function store(Request $request)
    {
        try{
            $categorie = new Categories;
            $categorie->name = $request->input('name');  
            $categorie->is_used = 0;  
            $categorie->save();  
            return $this->success("creation de la catégorie reussi", $categorie);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }  
    }

    /* **************************INDEX Categories ********************** */
    public function index()
    {
        try{
            $categorie = Categories::all(); 
            return $this->success("Catégories affichées", $categorie);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }   
    }

    /* **************************USED Categories ********************** */
    public function categorieUsed()
    {
        try{
            $categorieUsed=Categories::all();
            if(!$categorieUsed){
                return response()->json(['message'=>'ressource not found'], 403);
            }
            $categorieUsed = DB::table('categories')->select('categories.name as categorieName', 'categories.is_used as categorieUsed', 'categories.updated_at as categorieUpdate')
            ->where('categories.is_used', '=', 1)
            ->orderBy('categories.updated_at')
            ->get();
            $row[]=$categorieUsed;
            return $this->success("Catégories utilisées affichées", $row);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }   
    }

    /* **************************SHOW Categories ********************** */
    public function categorieShow($id)
    {
        try{
            $categorieShow=Categories::find($id);
            if(!$categorieShow){
                return response()->json(['message'=>'ressource not found'], 403);
            }
            $categorieShow = DB::table('categories')->select('categories.name as categorieName', 'categories.id as categorieId', 'categories.is_used as categorieUsed')
            ->where('categories.id', '=', $id)
            ->get();
            $row[]=$categorieShow;
            event(new CategorieEvent($categorieShow));
            return $this->success("Catégories affichées", $row);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }   
    }
        
    /* **************************SHOW Categories ********************** */
    public function show($id)
    {
 
            $categorie=Categories::find($id);
            if(!$categorie){
                return response()->json(['message'=>'ressource not found'], 403);
            }
            $categorie = DB::table('categories')->select('categories.name as categorieName', 'categories.id as categorieId', 'categories.is_used as categorieUsed')
            ->where('categories.id', '=', $id)
            ->get();
            $row1[]=$categorie;

            $quiz_id=DB::table('quizzes')
            ->where('categorie_id', '=', $id)
            ->pluck('id')
            ->random(1);
            [$quiz_id_random]=$quiz_id;

            $quiz = DB::table('quizzes')->select('quizzes.name as quizName', 'quizzes.id as quizId')
            ->join('categories', 'categories.id', '=', 'quizzes.categorie_id')
            ->where('categories.id', '=', $id)
            ->where('quizzes.id', '=', $quiz_id_random)
            ->get();

            $row2[]=$quiz;

            $teams_id=DB::table('teams')
            ->groupBy('id')
            ->pluck('id');
          
     
            $question_answer_id=DB::table('team_answers')
                ->pluck('question_id');
        
            $question_id=DB::table('questions')
            ->where('quiz_id', '=', $quiz_id_random)
            ->whereNotIn('questions.id', $question_answer_id)
            ->pluck('questions.id')
            ->random(1);
       
            [$question_id_random]=$question_id;

            $questions = DB::table('questions')->select('questions.name as questionName', 'questions.id as questionId')
                                                ->join('quizzes', 'quizzes.id', '=', 'questions.quiz_id')
                                                ->where('quizzes.id', '=', $quiz_id_random)
                                                ->where('questions.id', '=', $question_id_random)            
                                                ->get();

            $row3[]=$questions;

            $answers = DB::table('answers')->select('answers.name as answerName', 'answers.id as answerId')
                                            ->join('questions', 'questions.id', '=', 'answers.question_id')
                                            ->where('answers.question_id', '=', $question_id_random)
                                            ->get();
        
            $row4[]=$answers;
     

            $data=Arr::crossJoin($row1, $row2, $row3, $row4);
            event(new QuizEvent($data));
            return response()->json([
                'message' => "Catégories affichées",
                'data' => $data
            ]);
     
    }

    /* **************************UPDATE Categories ********************** */
    public function update(Request $request, $id)
    {
        try{
            $categorie = Categories::findOrFail($id);
            $categorie->update($request->all());
            return $this->success("mise a jour de la catégorie reussie", $categorie);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }  
    }

    /* **************************UPDATE USED COLOR ********************** */
    public function updateUsed()
    {
        try{
            $categorie=DB::table('categories')->update(['is_used' => 0]);
            return $this->success("mise a jour de la colonne is_used des catégories reussie", $categorie);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }  
    }

    /* **************************DELETE Categories ********************** */
    public function delete($id)
    {
        try{
            $categorie = Categories::findOrFail($id);
            $categorie->delete();
            return $this->success("suppression reussie", $categorie);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }  
}