<?php

namespace Database\Factories;

use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    protected $model = Stock::class;

    public function definition()
    {
        $stockNames = [
            'iPhone',
            'MacBook',
            'iPad',
            'Apple Watch',
            'AirPods',
            'Apple TV',
            'HomePod'
        ];

        $name = $this->faker->randomElement($stockNames);
        $open = $this->faker->randomFloat(2, 100, 200); // open price between 100 and 200
        $close = $this->faker->randomFloat(2, 100, 200); // close price between 100 and 200
        $low = min($open, $close) - $this->faker->randomFloat(2, 0, 10); // low price lower than both open and close
        $high = max($open, $close) + $this->faker->randomFloat(2, 0, 10); // high price higher than both open and close

        return [
            'name' => $name,
            'open' => $open,
            'close' => $close,
            'low' => $low,
            'high' => $high,
        ];
    }

}
