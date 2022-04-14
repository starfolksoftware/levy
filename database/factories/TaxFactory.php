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

        if (Levy::$supportsTeams) {
            $defs['team_id'] = Levy::newTeamModel()->factory();
        }

        return $defs;
    }
}
