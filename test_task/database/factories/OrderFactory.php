<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $count_product = rand(1, 3);
        $products_id = rand(1, 10);
        $price = (Product::where('id', $products_id)->first())->price;
        $verification = ['сбор', 'отправка', 'доставлен'];
        return [
            'buyers_id'=> rand(1, 10),
            'products_id'=> $products_id,
            'count_product'=> $count_product,
            'total_price'=> $price*$count_product,
            'order_status'=> $verification[array_rand($verification)],
        ];
    }
}
