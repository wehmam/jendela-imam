<?php

namespace App\Repository;

use App\Mail\InvoiceOrder;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderRepository {
    public static function findOrderById($id) {
        return Order::find($id);
    }

    public static function orderCar() {
        try {
            $bodyParams = request()->all();
            $order = Order::create([
                "customer_name" => $bodyParams["customer_name"],
                "phone" => $bodyParams["phone"],
                "email" => $bodyParams["email"],
                "car_id" => $bodyParams["cars"]
            ]);

            Mail::to($bodyParams["email"])->send(new InvoiceOrder($order));


            return responseCustom("Success order Cars", [], true, 200);
        } catch (\Throwable $th) {
            return responseCustom($th->getMessage());
        }
    }


    public static function ajaxCarsData() {
        try {
            $perPage = request()->get('length') ?? 10;
            $page = request()->get('start') / $perPage + 1;
            $offset = ($page - 1) * $perPage;
            $totalItems = DB::table('orders')->count();

            $orders = Order::with(['car'])
                ->orderBy('id', 'desc')
                ->skip($offset)
                ->take($perPage)
                ->get();

            $arrayData = collect([]);
            $response = [];

            if($orders) {
                $orders->each(function($q) use($arrayData) {
                    $arrayData->push([
                        $q->customer_name,
                        $q->email,
                        $q->phone,
                        $q->car->name ?? "-",
                        ("Rp. " . nominalFormat($q->car->price)) ?? "-"
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
