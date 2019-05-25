<?php

namespace App\Http\Controllers;

use App\EndpointCallSchedule;
use Illuminate\Http\Request;

class EndpointCallScheduleController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $request->validate([
            'endpoint_id' => 'required',
            'cron' => 'required|string'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EndpointCallSchedule  $endpointCallSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(EndpointCallSchedule $endpointCallSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EndpointCallSchedule  $endpointCallSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(EndpointCallSchedule $endpointCallSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EndpointCallSchedule  $endpointCallSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EndpointCallSchedule $endpointCallSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EndpointCallSchedule  $endpointCallSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(EndpointCallSchedule $endpointCallSchedule)
    {
        //
    }
}
