<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Vehicles;

class AdminVehicleController extends Controller
{
    //
    public function index(Request $request)
    {
        $vehicle_list = Vehicles::all();
        $menu = "vehicles";
        return view('backend.vehicles.index', compact("vehicle_list", "menu"));
    }

    public function save(Request $request) {
        $input = $request->all();
        if ($input['id'] == 0) {
            Vehicles::create($input);
            return back()->with("added", "Vehicle type is successfully added");
        } else {
            $vehicle = Vehicles::find($input['id']);
            $vehicle->name = $input['name'];
            $vehicle->icon = $input['icon'];
            $vehicle->save();
            return back()->with("updated", "Vehicle type is successfully udpated");
        }
    }

    public function get_list (Request $request) {
        $vehicle_list = Vehicles::get();
        return Datatables::of($vehicle_list)
                ->addIndexColumn()
                ->make(true);
    }
}
