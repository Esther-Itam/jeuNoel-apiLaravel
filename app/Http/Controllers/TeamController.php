<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Validation\TeamValidation;
use App\Models\Colors;
use App\Interfaces\TeamRepositoryInterface;

class TeamController extends Controller
{

    protected $teamInterface;

    public function __construct(TeamRepositoryInterface $teamInterface)
    {
        $this->teamInterface = $teamInterface;
    }
    
    /* **************************INDEX TEAM ********************** */
    public function index()
    {
        return $this->teamInterface->index();
    }
    
    /* **************************SHOW Teams ********************** */
    public function show($id)
    {
        return $this->teamInterface->show($id);
    }

    /* **************************STORE Teams ********************** */
    public function store(Request $request, TeamValidation $validation, Colors $color)
    {
        return $this->teamInterface->store($request, $validation, $color);
    }

    /* **************************DELETE Teams ********************** */
    public function delete()
    {
        return $this->teamInterface->delete();
    }

}
