<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register Interface and Repository in here
        // You must place Interface in first place
        // If you dont, the Repository will not get readed.
        $this->app->bind(
            'App\Interfaces\UserRepositoryInterface',
            'App\Repositories\UserRepository',
        );

        $this->app->bind(
            'App\Interfaces\CategorieRepositoryInterface',
            'App\Repositories\CategorieRepository',
        );

        $this->app->bind(
            'App\Interfaces\QuizRepositoryInterface',
            'App\Repositories\QuizRepository',
        );

        $this->app->bind(
            'App\Interfaces\QuestionRepositoryInterface',
            'App\Repositories\QuestionRepository',
        );
        
        $this->app->bind(
            'App\Interfaces\AnswerRepositoryInterface',
            'App\Repositories\AnswerRepository'
        );

        $this->app->bind(
            'App\Interfaces\TeamRepositoryInterface',
            'App\Repositories\TeamRepository',
        );

        $this->app->bind(
            'App\Interfaces\ColorRepositoryInterface',
            'App\Repositories\ColorRepository',
        );

        $this->app->bind(
            'App\Interfaces\AvatarRepositoryInterface',
            'App\Repositories\AvatarRepository',
        );

        $this->app->bind(
            'App\Interfaces\ResultRepositoryInterface',
            'App\Repositories\ResultRepository',
        );

        $this->app->bind(
            'App\Interfaces\TeamAnswerRepositoryInterface',
            'App\Repositories\TeamAnswerRepository',
        );
    }
}