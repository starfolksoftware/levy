<?php

namespace StarfolkSoftware\Levy\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use StarfolkSoftware\Levy\Tests\Mocks\TestProduct;

class TestProductFactory extends Factory
{
    protected $model = TestProduct::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
