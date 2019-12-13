<?php

use Illuminate\Http\Request;
use App\Events\SendLocation;

use App\Tracker;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/sendloc', function (Request $request) {
    $dId = $request->input('id');
    $device = $request->input('dev');
    $lat = $request->input('lat');
    $long = $request->input('long');
    $location = ["deviceId" => $dId, "device" => $device, "lat" => $lat, "long" => $long];
    event(new SendLocation($location));
    

    //Untuk Testing tanpa internet
    // $devTracker = new Tracker;
    // $devTracker->device_id = $dId;
    // $devTracker->t_lat = $lat;
    // $devTracker->t_lon = $long;
    // $devTracker->kategori = $device;
    // $devTracker->save();

    return response()->json(['status' => 'success', 'data' => $location]);
});

Route::post('/map', 'FleetTrackerAPI@store');

Route::get('/tracklast', 'FleetTrackerAPI@showTracklast');
