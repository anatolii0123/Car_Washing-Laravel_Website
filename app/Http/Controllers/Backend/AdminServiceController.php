<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Services;

class AdminServiceController extends Controller
{
    //
    public function index()
    {
        // $services = Service::all();
        $menu = "services";
        return view('backend.services.index', compact("menu"));
    }

    public function save(Request $request) {
        if ($request->id == 0) {
            $service = new Services();
        } else {
            $service = Services::find($request->id);
        }
        $service->name = $request->name;
        $service->description = $request->description;
        $service->duration = $request->duration;
        $service->price = $request->price;
        $service->save();
        if ($request->id == 0) {
            return back()->with("added", "Service is successfully added");
        } else {
            return back()->with("updated", "Service is successfully udpated");
        }
    }

    public function remove(Request $request) {
        $service = Services::find($request->id);
        $service->is_delete = 'Y';
        $service->save();
        return response(json_encode(['success' => true]));
    }

    public function get_list() {
        $service_list = Services::where("is_delete", 'N')->get();
        return Datatables::of($service_list)
            ->addIndexColumn()
            ->make(true);
    }
}
