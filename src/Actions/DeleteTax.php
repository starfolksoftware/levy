<?php

namespace StarfolkSoftware\Levy\Actions;

use StarfolkSoftware\Levy\Contracts\DeletesTaxes;
use StarfolkSoftware\Levy\Levy;
use StarfolkSoftware\Levy\Tax;

class DeleteTax implements DeletesTaxes
{
    /**
     * Delete a tax.
     *
     * @param  mixed  $user
     * @param  \StarfolkSoftware\Levy\Tax  $tax
     * @return void
     */
    public function __invoke($user, Tax $tax)
    {
        if (Levy::$validateTaxDeletion) {
            call_user_func(
                Levy::$validateTaxUpdate,
                $user,
                $tax
            );
        }

        $tax->delete();
    }
}
