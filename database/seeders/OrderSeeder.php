<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($offers)
    {
        $response = Http::get('https://run.mocky.io/v3/7f64b9df-190d-4d95-b829-7452575fa528');

        if ($response->successful()) {
            $orders = $response->json()['orders'];

            foreach ($offers as $offer) {

                $results = array_filter($orders, function ($var) use ($offer) {
                    return ($var['offerId'] == $offer['offerFilter']);
                });

                if (count($results) > 0) {
                    foreach ($results as $item) {
                        Order::create([
                            'offer_id' => $offer['offerId'],
                            'quantity' => $item['quantity'],
                            'order_date' => $item['orderDate'],
                        ]);
                    }
                }
            }
        } else {
            Log::error('OrderSeeder: API request failed.' . $response->body());
        }
    }
}
