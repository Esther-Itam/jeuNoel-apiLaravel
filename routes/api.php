<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\TeamAnswersController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\MailController;

use App\Models\Teams;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);
Route::get('/index', [AuthenticationController::class, 'index']);
Route::get('/show/{id}', [AuthenticationController::class, 'show'])->middleware('App\Http\Middleware\React');
Route::put('update/{id}', [AuthenticationController::class, 'update']);

Route::post('/teamBuilding', [TeamController::class, 'store'])->middleware('App\Http\Middleware\React');
Route::get('/teamPresentation', [TeamController::class, 'index']);
Route::get('/teamShow/{id}', [TeamController::class, 'show']);
Route::delete('/teamDelete', [TeamController::class, 'delete']);

Route::get('/color', [ColorController::class, 'index']);
Route::put('color/{id}', [ColorController::class, 'update']);
Route::put('color', [ColorController::class, 'updateUsed']);
Route::get('/color/{id}', [ColorController::class, 'show']);

Route::get('/avatar', [AvatarController::class, 'index']);

Route::post('/question', [QuestionController::class, 'store']);
Route::get('/question', [QuestionController::class, 'index']);
Route::put('question/{id}', [QuestionController::class, 'update']);

Route::post('/answer', [AnswerController::class, 'store']);
Route::get('/answer', [AnswerController::class, 'index']);
Route::put('answer/{id}', [AnswerController::class, 'update']);

Route::post('/quiz', [QuizController::class, 'store']);
Route::get('quiz', [QuizController::class, 'index']);
Route::get('quiz/{id}', [QuizController::class, 'show']);
Route::put('quiz/{id}', [QuizController::class, 'update']);
Route::delete('quiz/{id}', [QuizController::class, 'delete']);

Route::post('/categorie', [CategorieController::class, 'store']);
Route::get('categorie', [CategorieController::class, 'index']);
Route::get('categorie/{id}', [CategorieController::class, 'show']);
Route::get('categorieShow/{id}', [CategorieController::class, 'categorieShow']);
Route::get('categorieUsed', [CategorieController::class, 'categorieUsed']);
Route::put('categorie/{id}', [CategorieController::class, 'update']);
Route::put('categorie', [CategorieController::class, 'updateUsed']);
Route::delete('categorie/{id}', [CategorieController::class, 'delete']);

Route::post('/team_answers', [TeamAnswersController::class, 'store']);
Route::get('/team_answers/index', [TeamAnswersController::class, 'index']);
Route::get('/team_answers', [TeamAnswersController::class, 'show']);
Route::get('/team_showAnswers', [TeamAnswersController::class, 'showAnswers']);
Route::delete('/teamAnswersDelete', [TeamAnswersController::class, 'delete']);

Route::get('/results', [ResultController::class, 'index']);

Route::get('/env', function(){
    return response()->json([
        'connection'=>env('DB_CONNECTION'),
        'host'=>env('DB_HOST'),
        'port'=>env('DB_PORT'),
        'database'=>env('DB_DATABASE'),
        'username'=>env('DB_USERNAME'),
        'password'=>env('DB_PASSWORD')
    ]);
}); 