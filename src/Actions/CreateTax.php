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
     * @param  mixed  $tenantId
     * @return \StarfolkSoftware\Levy\Tax
     */
    public function __invoke($user, array $data, $tenantId = null)
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

        $fields = collect($data)->only([
            'type',
            'name',
            'rate',
        ])->toArray();

        return Levy::$supportsTenants ?
            Levy::findTenantByIdOrFail($tenantId)->taxes()->create($fields) : 
            Levy::newTaxModel()->create($fields);
    }
}