<?php

namespace App\Http\Controllers;

use App\Api;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return Api[]|Collection
	 */
    public function index()
    {
        return Api::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required|string',
			'base_url' => 'required|string|url',
			'bearer' => 'string',
			'client_id' => 'string',
			'client_secred' => 'string',
		]);

		return Api::create($request->all());
	}

    /**
     * Display the specified resource.
     *
     * @param Api $api
     * @return Api
     */
    public function show(Api $api)
    {
		return $api;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Api $api
     * @return Response
     */
    public function edit(Api $api)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Api $api
     * @return Response
     */
    public function update(Request $request, Api $api)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Api $api
     * @return Response
     */
    public function destroy(Api $api)
    {
        //
    }
}
