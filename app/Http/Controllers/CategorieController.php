<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\CategorieRepositoryInterface; 

class CategorieController extends Controller
{  
    protected $categorieInterface;

    public function __construct(CategorieRepositoryInterface $categorieInterface)
    {
        $this->categorieInterface = $categorieInterface;
    }

    /* **************************CREATE Categories ********************** */
    public function store(Request $request)
    {
        return $this->categorieInterface->store($request);
    }

    /* **************************INDEX Categories ********************** */
    public function index()
    {
        return $this->categorieInterface->index();
    }

    /* **************************USED Categories ********************** */
    public function categorieUsed()
    {
        return $this->categorieInterface->categorieUsed();
    }

    /* **************************SHOW Categories ********************** */
    public function categorieShow($id)
    {
        return $this->categorieInterface->categorieShow($id);
    }
        
    /* **************************SHOW Categories ********************** */
    public function show($id)
    {
        return $this->categorieInterface->show($id);
    }

    /* **************************UPDATE Categories ********************** */
    public function update(Request $request, $id)
    {
        return $this->categorieInterface->update($request, $id);
    }

    /* **************************UPDATE USED COLOR ********************** */
    public function updateUsed()
    {
        return $this->categorieInterface->updateUsed();
    }

    /* **************************DELETE Categories ********************** */
    public function delete($id)
    {
        return $this->categorieInterface->delete($id);
    }
}
