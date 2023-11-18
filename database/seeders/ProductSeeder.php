<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::get('https://run.mocky.io/v3/1d4edd1f-ecea-4972-9afe-713d78b6f534');

        if ($response->successful()) {
            $products = $response->json()['products'];

            $productArray = [];
            foreach ($products as $item) {
                $product = Product::create([
                    'name' => $item['name'],
                    'category' => $item['category'],
                    'price' => (float)$item['price'],
                ]);

                $productArray[] = [
                    'productId' => $product->id,
                    'productFilter' => $item['id'],
                ];
            }

            $this->call(OfferSeeder::class, false, ['products' => $productArray]);
        } else {
            Log::error('ProductSeeder: API request failed.' . $response->body());
        }
    }
}
