<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Locations;
use App\Models\LocationServices;
use App\Models\LocationVehicles;
use App\Models\LocationPesuboxs;
use App\Models\Orders;
use App\Models\Services;
use App\Models\Bookings;
use App\Models\Mark;
use App\Models\MarkModel;
use Carbon\Carbon;

class AdminController extends Controller
{
    
    //
    public function index(Request $request) {
        $menu = "home";
        $locations = Locations::where("is_delete", 'N')->get();
        $current_location_id = $request->location_id ? $request->location_id : (count($locations) > 0 != null ? $locations[0]->id : 0);
        
        return view('backend.home.index', compact("menu", "locations", "current_location_id"));
    }
    
    public function getCalendar(Request $request) {
        $start_date = $request->start_date ? $request->start_date : date("Y-m-d");
        $year = date("M Y", strtotime($start_date));
        $end_date = date("Y-m-d", strtotime($start_date. ' + 3 days'));
        $pesuboxs = LocationPesuboxs::where("location_id", $request->current_location_id)->where("is_delete", 'N')->get();
        $orders = Bookings::where("location_id", $request->current_location_id)->whereBetween("date", [$start_date, $end_date])->where("is_delete", 'N')->get();
        $data = [];
        foreach($orders as $order) {
            $item = [];
            $item['uid'] = $order->id;
            $item['begins'] = $order->date . ' ' . $order->time;
            $endTime = strtotime("+" . $order->duration . " minutes", strtotime($item['begins']));
            $item['ends'] = $order->date . ' ' . date('H:i:s', $endTime);
            $item['color'] = "#dddddd";
            $item['resource'] = $order->pesubox_id;
            $item['title'] = "";
            $item['notes'] = "";
            $mark = Mark::find($order->mark_id);
            if ($mark) {
                $item['notes'] .= $mark->name;
            }
            $mark_model = MarkModel::find($order->model_id);
            if ($mark_model) {
                $item['notes'] .= " (" . $mark_model->model . ") ";
            }
            $item['notes'] .= "\n";
            $arr_service = explode(",", $order->service_id);
            foreach($arr_service as $service_id) {
                if ($service_id != null) {
                    $service = Services::find($service_id);
                    $item['notes'] .= $service->name . ", ";
                }
            }
            // $item['notes'] = "test";
            $data[] = (object)$item;
        }
        return view('backend.home.components.calendar', compact("start_date", "pesuboxs", "data", "year"))->render();
    }

    public function editOrder(Request $request) {
        $id = $request->id;
        $location_id = $request->location_id;
        $order = Bookings::find($id);

        /* get mark and model to database */
        /*ini_set('max_execution_time', 600);
        $mark_list = [
            1 => "Acura",
            2 => "Alfa",
            77 => "Aston",
            3 => "Audi",
            4 => "Austin",
            5 => "Bentley",
            6 => "BMW",
            7 => "Brilliance",
            8 => "Buick",
            9 => "Cadillac",
            69 => "Chery",
            10 => "Chevrolet",
            11 => "Chrysler",
            12 => "Citroen",
            13 => "Dacia",
            14 => "Daewoo",
            15 => "Daihatsu",
            16 => "Datsun",
            17 => "Dodge",
            18 => "Eagle",
            76 => "Ferrari",
            19 => "Fiat",
            20 => "Ford",
            21 => "GAZ",
            22 => "Geo",
            23 => "GMC",
            70 => "Great",
            24 => "Honda",
            25 => "Hummer",
            26 => "Hyundai",
            27 => "Infiniti",
            28 => "Isuzu",
            29 => "Iveco",
            30 => "Jaguar",
            31 => "Jeep",
            32 => "Kia",
            33 => "Lada",
            75 => "Lamborghini",
            34 => "Lancia",
            35 => "Land",
            36 => "Lexus",
            72 => "Lifan",
            37 => "Lincoln",
            38 => "LuAZ",
            73 => "Maserati",
            39 => "Mazda",
            40 => "Mercedes",
            41 => "Mercury",
            74 => "MG",
            42 => "Mini",
            43 => "Mitsubishi",
            44 => "Moskvich",
            45 => "Nissan",
            46 => "Oldsmobile",
            47 => "Opel",
            48 => "Peugeot",
            49 => "Plymouth",
            50 => "Pontiac",
            51 => "Porsche",
            52 => "RAF",
            53 => "Renault",
            54 => "Rover",
            55 => "Saab",
            56 => "Saturn",
            71 => "Scion",
            57 => "Seat",
            58 => "Skoda",
            59 => "Smart",
            60 => "Ssangyong",
            61 => "Subaru",
            62 => "Suzuki",
            68 => "Tesla",
            63 => "Toyota",
            64 => "UAZ",
            65 => "Volkswagen",
            66 => "Volvo",
            67 => "ZA"
        ];
        $i = 0;
        foreach($mark_list as $key=>$mark) {
            $i++;
            $make = Mark::where("name", $mark)->get();
            if (count($make) > 0) {
                continue;
            }
            $make = new Mark();
            $make->name = $mark;
            $make->save();
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://nano-zen.com/booking/public/models?id=' . $key);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            $data = json_decode($response, true);
            
            foreach($data as $key1 => $item) {
                $model = new MarkModel();
                $model->mark_id = $i;
                $model->model = $item['name'];
                $model->save();
            }
            curl_close($curl);
        }
        return; */

        $location_vehicles = LocationVehicles::leftJoin('vehicles', 'vehicles.id', '=', 'location_vehicles.vehicle_id')->where("location_id", $request->location_id)->get();
        $location_services = LocationServices::leftJoin('services', 'services.id', '=', 'location_services.service_id')->where("location_id", $request->location_id)->where("services.is_delete", "N")->get();
        $location_pesuboxs = LocationPesuboxs::where("location_id", $request->location_id)->where("is_delete", 'N')->where("status", 1)->get();
        $location_marks = Mark::get();
        $location_mark_models = [];
        $end_time = "";
        if ($order != null) {
            $location_mark_models = MarkModel::where("mark_id", $order->mark_id)->get();
            $time = Carbon::parse($order->date . " " . $order->time);
            $end_time = $time->addMinutes($order->duration)->format('Y-m-d H:i:s');
        }

        // $end_time = $time->format('Y-m-d H:i');
        $location = Locations::find($location_id);
        $location_lasttimes = json_encode([
            "1" => $location->Mon_end,
            "2" => $location->Tue_end,
            "3" => $location->Wed_end,
            "4" => $location->Thu_end,
            "5" => $location->Fri_end,
            "6" => $location->Sat_end,
            "0" => $location->Sun_end,
        ]);
        // $location_starttimes = json_encode([
        //     1 => $location->Mon_start,
        //     2 => $location->Tue_start,
        //     3 => $location->Wed_start,
        //     4 => $location->Thu_start,
        //     5 => $location->Fri_start,
        //     6 => $location->Sat_start,
        //     0 => $location->Sun_start,
        // ]);
        return view('backend.home.components.modal', compact("order", "id", "location_lasttimes", "location_id", "location_vehicles", "location_services", "location_pesuboxs", "location_marks", "location_mark_models", "end_time"))->render();
    }

    public function updateOrder(Request $request) {
        // $service_id = []
        // $request->service_id
        $order = Bookings::find($request->id);
        if ($order == null) {
            $order = new Bookings();
        } 
        // check start time in database already.
        $order_already = Bookings::where("location_id", $request->location_id)->where('pesubox_id', $request->pesubox_id)->where("is_delete", "N")
            ->where(function($query1) use($request) {
                $query1->where(function($query) use($request)
                {
                    $query->where("started_at", "<=", $request->datetime);
                    $query->where(DB::raw("DATE_ADD(started_at, INTERVAL duration - 1 MINUTE)"), ">", $request->datetime);
                });
                $query1->orwhere(function($query) use($request)
                {
                    $query->where("started_at", "<", date("Y-m-d H:i:s", strtotime($request->datetime. ' + ' . ($request->duration - 1) . ' minutes')));
                    $query->where(DB::raw("DATE_ADD(started_at, INTERVAL duration - 1 MINUTE)"), ">", date("Y-m-d H:i:s", strtotime($request->datetime. ' + ' . $request->duration . ' minutes')));
                });
                $query1->orwhere(function($query) use($request)
                {
                    $query->where("started_at", ">", $request->datetime);
                    $query->where(DB::raw("DATE_ADD(started_at, INTERVAL duration MINUTE)"), "<", date("Y-m-d H:i:s", strtotime($request->datetime. ' + ' . $request->duration . ' minutes')));
                });
            })
            ->first();

        // var_dump($request->datetime);
        // var_dump(date("Y-m-d H:i:s", strtotime($request->datetime. ' + ' . $request->duration . ' minutes')));
        // var_dump($order_already);
        // return;
        if ($order_already != null) {
            return response(json_encode(['success' => false, "message" => "Your booking time was already booked"]));
        }
        $order->location_id = $request->location_id;
        if ($request->driver != null) 
            $order->driver = $request->driver;
        else
            $order->driver = '';

        if ($request->email != null) 
            $order->email = $request->email;
        else
            $order->email = '';

        if ($request->phone != null) 
            $order->phone = $request->phone;
        else
            $order->phone = '';

        if ($request->number != null) 
            $order->number = $request->number;
        else
            $order->number = '';

        if ($request->summary != null) 
            $order->summary = $request->summary;
        else
            $order->summary = '';
        
        $order->is_delete = 'N';
        if ($request->service_id != null) 
            $order->service_id = $request->service_id;
        else 
            $order->service_id = "";
        
        $order->pesubox_id = $request->pesubox_id;
        $order->vehicle_id = $request->vehicle_id;
        $order->mark_id = $request->mark_id;
        $order->model_id = $request->model_id;
        $order->duration = $request->duration;
        $order->started_at = $request->datetime;
        $order->date = substr($request->datetime, 0, 10);
        $order->time = substr($request->datetime, 11, 5) . ":00";
        // var_dump($request->datetime);exit;
        $order->save();
        return response(json_encode(['success' => true]));
    }

    public function deleteOrder(Request $request) {
        $order = Bookings::find($request->id);
        $order->is_delete = 'Y';
        $order->save();
        return response(json_encode(['success' => true]));
    }
 
    public function getModel(Request $request) {
        $location_mark_models = MarkModel::where("mark_id", $request['mark_id'])->get();
        return view('backend.home.components.model', compact("location_mark_models"))->render();
    }

    public function getDayEndTime(Request $request) {
        $day = mktime(0, 0, 0, substr($request->date, 5, 2), substr($request->date, 8, 2), substr($request->date, 0, 4));
        $location = Locations::find($request->location_id);
        $time_end = $location[date("D", $day) . '_end'];
        $from_time = strtotime($request->date);
        $to_time = strtotime(substr($request->date, 0, 10) . " " . $time_end);
        $difference = round(abs($to_time - $from_time) / 60,2);
        
        return response(json_encode(['difference' => $difference, "end_time" => substr($request->date, 0, 10) . " " . $time_end]));
    }
}
