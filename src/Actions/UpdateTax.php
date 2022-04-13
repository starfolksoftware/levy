<?php

namespace StarfolkSoftware\Levy\Actions;

use Illuminate\Support\Facades\Validator;
use StarfolkSoftware\Levy\Contracts\UpdatesTaxes;
use StarfolkSoftware\Levy\Levy;
use StarfolkSoftware\Levy\Tax;

class UpdateTax implements UpdatesTaxes
{
    /**
     * Update a tax.
     *
     * @param  mixed  $user
     * @param  \StarfolkSoftware\Levy\Tax  $tax
     * @param  array  $data
     * @return \StarfolkSoftware\Levy\Tax
     */
    public function __invoke($user, Tax $tax, array $data)
    {
        if (Levy::$validateTaxCreation) {
            call_user_func(
                Levy::$validateTaxUpdate,
                $user,
                $tax,
                $data
            );
        }

        Validator::make($data, [
            'type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'rate' => 'required|numeric',
        ])->validateWithBag('updateTax');

        $tax->update(collect($data)->only([
            'type',
            'name',
            'rate',
        ])->toArray());

        return $tax->refresh();
    }
}
