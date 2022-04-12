<?php

namespace StarfolkSoftware\Levy\Actions;

use Illuminate\Support\Facades\Validator;
use StarfolkSoftware\Levy\Contracts\CreatesTaxes;
use StarfolkSoftware\Levy\Levy;

class CreateTax implements CreatesTaxes
{
    /**
     * Create a new tax.
     *
     * @param  mixed  $user
     * @param  array  $data
     * @return \StarfolkSoftware\Levy\Tax
     */
    public function __invoke($user, array $data)
    {
        if (Levy::$validateTaxCreation) {
            call_user_func(
                Levy::$validateTaxCreation,
                $user,
                $data
            );
        }

        Validator::make($data, [
            'type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'rate' => 'required|numeric',
        ])->validateWithBag('createTax');

        return Levy::$supportsTenants ?
            Levy::newTenantModel()->taxes()->create($data) : 
            Levy::newTaxModel()->create($data);
    }
}