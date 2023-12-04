<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarsRequest;
use App\Models\Car;
use App\Repository\AuthRepository;
use App\Repository\CarRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("back.cars.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("back.cars.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarsRequest $request)
    {
        $response = CarRepository::createOrUpdateCars();

        if(!$response["status"]) {
            alertNotify(false, $response["message"]);
            return back()->withInput();
        }

        alertNotify(true, $response["message"]);
        return redirect(url("management/cars"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect(url("management"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        return view("back.cars.form", compact("car"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarsRequest $request, $id)
    {
        $response = CarRepository::createOrUpdateCars($id);
        if(!$response["status"]) {
            alertNotify(false, $response["message"]);
            return back()->withInput();
        }

        alertNotify(true, $response["message"]);
        return redirect(url("management/cars"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(CarRepository::delete($id));
    }

    public function listAjaxCars()  {
        return response()->json(CarRepository::ajaxCarsData());
    }
}
