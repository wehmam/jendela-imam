<?php

namespace App\Repository;

use App\Models\Car;
use App\Models\Order;
use App\Models\OrderCar;
use Illuminate\Support\Facades\DB;

class CarRepository {
    public static function findCarById($id) {
        return Car::find($id);
    }

    public static function getAllCars() {
        return Car::select("id", "name", "price")
            ->get();
    }

    public static function delete($id) {
        try {
            $car = self::findCarById($id);
            if(!$car) {
                return responseCustom("Cars not found", [], false, 404);
            }

            $orders = Order::where("car_id", $id)
                ->count();

            if ($orders > 0) {
                return responseCustom("Cannot delete cars, because cars has order", [] , false, 400);
            }

            $car->delete();

            return responseCustom("Success Delete Car", [], true, 200);
        } catch (\Throwable $th) {
            return responseCustom($th->getMessage());
        }
    }

    public static function createOrUpdateCars($id = null) {
        try {
            $bodyParams = request()->all();

            Car::updateOrCreate(
                ['id' => $id],
                [
                    'name' => $bodyParams["name"],
                    'price' => $bodyParams["price"],
                    'stock' => $bodyParams["stock"]
                ]
            );

            return responseCustom("Success " . (!$id ? "Add" : "Update") . " Cars", [] , true, 200);
        } catch (\Throwable $th) {
            return responseCustom($th->getMessage());
        }
    }

    public static function ajaxCarsData() {
        try {
            $perPage = request()->get('length') ?? 10;
            $page = request()->get('start') / $perPage + 1;
            $offset = ($page - 1) * $perPage;
            $totalItems = DB::table('cars')->count();

            $cars = DB::table('cars')
                ->orderBy('id', 'desc')
                ->skip($offset)
                ->take($perPage)
                ->get();

            $arrayData = collect([]);
            $response = [];
            if($cars) {

                $cars->each(function($q) use($arrayData) {
                    $arrayData->push([
                        $q->name ,
                        "Rp. " . nominalFormat($q->price),
                        $q->stock,
                        '
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="'.url("management/cars/$q->id/edit").'"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="deleteCars('.$q->id.')"><i class="bx bx-trash-alt me-2"></i> Delete</a>

                                </div>
                            </div>
                        '
                    ]);
                });

                $response = [
                    "draw" => request()->get("draw"),
                    "recordsTotal" => $totalItems ?? 0,
                    "recordsFiltered" => $totalItems ?? 0,
                    "data" => $arrayData->toArray()
                ];
            }

            return $response;
        } catch (\Throwable $th) {
            return [];
        }
    }
}
