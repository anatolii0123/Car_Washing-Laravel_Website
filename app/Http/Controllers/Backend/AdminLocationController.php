<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Locations;
use App\Models\Services;
use App\Models\Vehicles;
use App\Models\LocationServices;
use App\Models\LocationVehicles;
use App\Models\LocationPesuboxs;
use App\Models\LocationUsers;
use App\Models\User;
use DataTables;

class AdminLocationController extends Controller
{
    //
    public function index(Request $request)
    {
        // $services = Service::all();
        $menu = "locations";
        return view('backend.locations.index', compact("menu"));
    }

    public function save(Request $request) {
        $location = new Locations();
        $location->name = $request->name;
        $location->save();
        return back()->with("added", "Service is successfully added");
    }

    public function get_list (Request $request) {
        $location_list = Locations::where("is_delete", "N")->get();
        return Datatables::of($location_list)
            ->addIndexColumn()
            ->make(true);
    }

    public function edit(Request $request) {
        $location = Locations::find($request->id);
        $menu = "locations";
        $id = $request->id;
        return view('backend.locations.edit', compact("location", "menu", "id"));
    }

    public function delete(Request $request) {
        $location = Locations::find($request->id);
        $location->is_delete = 'Y';
        $location->save();
        return response(json_encode(['success' => true]));
    }

    public function save_general(Request $request) {
        $location = Locations::find($request->id);
        $location->name = $request->name;
        $location->description = $request->description;
        $location->Mon_start = $request->Mon_start;
        $location->Mon_end = $request->Mon_end;
        $location->Tue_start = $request->Tue_start;
        $location->Tue_end = $request->Tue_end;
        $location->Wed_start = $request->Wed_start;
        $location->Wed_end = $request->Wed_end;
        $location->Thu_start = $request->Thu_start;
        $location->Thu_end = $request->Thu_end;
        $location->Fri_start = $request->Fri_start;
        $location->Fri_end = $request->Fri_end;
        $location->Sat_start = $request->Sat_start;
        $location->Sat_end = $request->Sat_end;
        $location->Sun_start = $request->Sun_start;
        $location->Sun_end = $request->Sun_end;
        $location->interval = $request->interval;
        $location->address = $request->address;
        $location->street = $request->street;
        $location->city = $request->city;
        $location->save();
        return response(json_encode(['success' => true]));
    }

    public function getLocationServices(Request $request) {
        $services = Services::where("is_delete", "N")->get();
        $location_id = $request->id;
        $location_services = LocationServices::where("location_id", $request->id)->get();
        $location_service_array = [];
        foreach($location_services as $location_service) {
            array_push($location_service_array, $location_service->service_id);
        }
        return view('backend.locations.components.services', compact("services", "location_id", "location_service_array"))->render();
    }

    public function saveLocationService(Request $request) {
        if ($request->is_checked == 'true') {
            $location_service = new LocationServices();
            $location_service->location_id = $request->location_id;
            $location_service->service_id = $request->service_id;
            $location_service->save();
        } else {
            $location_service = LocationServices::where("location_id", $request->location_id)->where("service_id", $request->service_id)->delete();
        }
        return response(json_encode(['success' => true]));
    }

    public function getLocationVehicles(Request $request) {
        $vehicles = Vehicles::where("is_delete", "N")->get();
        $location_id = $request->id;
        $location_vehicles = LocationVehicles::where("location_id", $request->id)->get();
        $location_vehicle_array = [];
        foreach($location_vehicles as $location_vehicle) {
            array_push($location_vehicle_array, $location_vehicle->vehicle_id);
        }
        return view('backend.locations.components.vehicles', compact("vehicles", "location_id", "location_vehicle_array"))->render();
    }

    public function saveLocationVehicle(Request $request) {
        if ($request->is_checked == 'true') {
            $location_vehicle = new LocationVehicles();
            $location_vehicle->location_id = $request->location_id;
            $location_vehicle->vehicle_id = $request->vehicle_id;
            $location_vehicle->save();
        } else {
            $location_vehicle = LocationVehicles::where("location_id", $request->location_id)->where("vehicle_id", $request->vehicle_id)->delete();
        }
        return response(json_encode(['success' => true]));
    }

    public function getLocationPesuboxs(Request $request) {
        $location_id = $request->id;
        $location_pesuboxs = LocationPesuboxs::where("location_id", $request->id)->where("is_delete", 'N')->get();
        
        return view('backend.locations.components.pesuboxs', compact("location_id", "location_pesuboxs"))->render();
    }

    public function getLocationPesubox(Request $request) {
        $location_pesubox = LocationPesuboxs::find($request->id);
        return response(json_encode(['success' => true, "data" => $location_pesubox]));
    }

    public function saveLocationPesubox(Request $request) {
        if ($request->location_pesubox_id == 0) {
            $location_pesubox = new LocationPesuboxs();
        } else {
            $location_pesubox = LocationPesuboxs::find($request->location_pesubox_id);
        }
        $location_pesubox->name = $request->name;
        $location_pesubox->description = $request->description;
        $location_pesubox->location_id = $request->location_id;
        $location_pesubox->save();
        return response(json_encode(['success' => true]));
    }

    public function deleteLocationPesubox(Request $request) {
        $location_pesubox = LocationPesuboxs::find($request->id);
        $location_pesubox->is_delete = 'Y';
        $location_pesubox->save();
        return response(json_encode(['success' => true]));
    }

    public function saveLocationPesuboxStatus(Request $request) {
        $location_pesubox = LocationPesuboxs::find($request->id);
        $location_pesubox->status = $request->status == 'true'? 1 : 0;
        $location_pesubox->save();
        return response(json_encode(['success' => true]));
    }

    public function getLocationUsers(Request $request) {
        $users = User::get();
        $location_id = $request->id;
        $location_users = LocationUsers::leftJoin('users', 'users.id', '=', 'location_users.user_id')->where("location_users.location_id", $request->id)->get();
        
        return view('backend.locations.components.users', compact("location_id", "location_users", "users"))->render();
    }

    public function saveLocationUser(Request $request) {
        if ($request->location_user_id == 0) {
            $location_user = new LocationUsers();
        } else {
            $location_user = LocationUsers::find($request->user_id);
        }
        $location_user->location_id = $request->location_id;
        $location_user->user_id = $request->user_id;
        $location_user->save();
        return response(json_encode(['success' => true]));
    }

    public function saveLocationUserStatus(Request $request) {
        $location_user = LocationUsers::find($request->id);
        $location_user->status = $request->status == 'true' ? 1 : 0;
        $location_user->save();
        return response(json_encode(['success' => true]));
    }

    public function getLocationUser(Request $request) {
        $location_user = LocationUsers::find($request->id);
        return response(json_encode(['success' => true, "data" => $location_user]));
    }

    
}
