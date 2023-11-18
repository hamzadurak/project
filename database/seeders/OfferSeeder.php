<?php

namespace Database\Seeders;

use App\Enumerations\Offers\AvailabilityEnum;
use App\Enumerations\Offers\ConditionEnum;
use App\Models\Offer;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($products)
    {
        $response = Http::get('https://run.mocky.io/v3/5a4b809b-c72a-4ab2-9acd-f63dc95a9755');
        if ($response->successful()) {
            $offers = $response->json()['offers'];

            $offersArray = [];
            foreach ($products as $product) {

                $results = array_filter($offers, function ($var) use ($product) {
                    return ($var['productId'] == $product['productFilter']);
                });

                if (count($results) > 0) {
                    foreach ($results as $item) {

                        $sellerId = substr($item['sellerId'], 1);

                        $offer = Offer::create([
                            'product_id' => $product['productId'],
                            'seller_id' => $sellerId,
                            'price' => (float)$item['price'],
                            'condition' => $this->condition($item['condition']),
                            'availability' => $this->availability($item['availability']),
                        ]);

                        $offersArray[] = [
                            'offerId' => $offer->id,
                            'offerFilter' => $item['offerId'],
                        ];
                    }
                }
            }

            if (count($offersArray) > 0) {
                $this->call(OrderSeeder::class, false, ['offers' => $offersArray]);
            }

        } else {
            Log::error('OfferSeeder: API request failed.' . $response->body());
        }
    }


    /**
     * @param $condition
     * @return string
     */
    public function condition($condition): string
    {
        switch (mb_strtolower($condition)) {
            case 'kullanılmış':
                return ConditionEnum::USED;
                break;
            default:
                return ConditionEnum::NEW;
                break;
        }
    }

    /**
     * @param $availability
     * @return string
     */
    public function availability($availability): string
    {
        switch (mb_strtolower($availability)) {
            case 'stokta':
                return AvailabilityEnum::IN_STOCK;
                break;
            default:
                return AvailabilityEnum::OUT_OF_STOCK;
                break;
        }
    }
}
