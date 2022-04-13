<?php

namespace StarfolkSoftware\Levy\Contracts;

use StarfolkSoftware\Levy\Tax;

interface DeletesTaxes
{
    /**
     * Delete an existing tax.
     *
     * @param  mixed  $user
     * @param  \StarfolkSoftware\Levy\Tax  $tax
     * @return void
     */
    public function __invoke($user, Tax $tax);
}
