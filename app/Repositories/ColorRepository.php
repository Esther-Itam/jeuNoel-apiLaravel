<?php namespace App\Repositories;

use App\Models\Colors;
use App\Interfaces\ColorRepositoryInterface;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\Websockets;
use App\Events\MyEvent;
use App\Events\StatusLiked;
use App\Events\ColorUsedEvent;

class ColorRepository implements ColorRepositoryInterface
{

    // Use ResponseAPI Trait in this repository
    use ResponseAPI;

    /* **************************INDEX COLOR ********************** */
    public function index()
    {
        try{
            $color = Colors::all();
            $color = DB::table('colors')->select('colors.color as colorName', 'colors.id as colorId', 'colors.is_used as colorUsed')
            ->get();

            $row[]=$color;
            event(new ColorUsedEvent($color));
            return $this->success("Couleurs affichées", $row);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }    
    }

    /* **************************UPDATE COLOR ********************** */
    public function update(Request $request, $id)
    {
        try{
            $color = Colors::findOrFail($id);
            $color->update($request->all());
            return $this->success("mise a jour de la couleur reussie", $color);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        } 
    }

    /* **************************UPDATE USED COLOR ********************** */
    public function updateUsed()
    {
        try{
            $color=DB::table('colors')->update(['is_used' => 0]);
            return $this->success("mise a jour de la colonne is_used des couleurs reussie", $color);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        } 
    }

    /* **************************SHOW COLOR ********************** */
    public function show($id)
    {
        try{
            $color=Colors::find($id);
            $color = DB::table('colors')->select('colors.color as colorName', 'colors.id as colorId', 'colors.is_used as colorUsed')
            ->join('teams', 'teams.color_id', '=', 'colors.id')
            ->where('colors.id', '=', $id)
            ->get();

            $row[]=$color;
            return $this->success("couleurs affichées", $row);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        } 
    }
      
  
} 