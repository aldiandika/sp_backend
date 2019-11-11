<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tracker;

use DB;

class FleetTrackerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = [];

        $device_id = $request->input('device_id');
        $t_lat = $request->input('t_lat');
        $t_lon = $request->input('t_lon');
        $kategori = $request->input('kategori');

        $devTracker = new Tracker;
        $devTracker->device_id = $device_id;
        $devTracker->t_lat = $t_lat;
        $devTracker->t_lon = $t_lon;
        $devTracker->kategori = $kategori;
        $devTracker->save();

        $response['Your Location Has been Saved'] = 1;
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTracklast()
    {
        $allData = Tracker::all();
        $lastData = collect($allData)->last();

        return response()->json($lastData);
    }

    // Show backpack track
    public function showTrackBP($request)
    { }

    // Show robot track
    public function showTrackRB($request)
    { }

    // Show uav track
    public function showTrackUAV($request)
    { }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
