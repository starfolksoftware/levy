<?php

namespace StarfolkSoftware\Levy\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use StarfolkSoftware\Levy\Levy;
use StarfolkSoftware\Levy\Tax;

class TaxFactory extends Factory
{
    protected $model = Tax::class;

    public function definition()
    {
        $defs = [
            'type' => $this->faker->randomElement(['fixed', 'inclusive', 'normal', 'withholding']),
            'name' => $this->faker->word,
            'rate' => $this->faker->randomFloat(2, 0, 100),
        ];

        if (Levy::$supportsTenants) {
            $defs['tenant_id'] = Levy::newTenantModel()->factory();
        }

        return $defs;
    }
}
