<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\ColorRepositoryInterface; 


class ColorController extends Controller
{

    protected $colorInterface;

    public function __construct(ColorRepositoryInterface $colorInterface)
    {
        $this->colorInterface = $colorInterface;
    }

    /* **************************INDEX COLOR ********************** */
    public function index()
    {
        return $this->colorInterface->index();
    }
     
    /* **************************UPDATE COLOR ********************** */
    public function update(Request $request, $id)
    {
        return $this->colorInterface->update($request, $id);
    }

    /* **************************UPDATE USED COLOR ********************** */
    public function updateUsed()
    {
        return $this->colorInterface->updateUsed();
    }

    /* **************************SHOW COLOR ********************** */
    public function show($id)
    {
        return $this->colorInterface->show($id);
    }
}