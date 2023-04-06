<?php

namespace App\Http\Controllers;

use App\Models\Cell;
use App\Models\Sector;

class CellController extends Controller
{
    public function getCells(Sector $sector)
    {
        return response()->json(
            $sector->cells()->get()
        );
    }

    public function getVillages(Cell $cell)
    {
        return response()->json(
            $cell->villages()->get()
        );
    }
}
