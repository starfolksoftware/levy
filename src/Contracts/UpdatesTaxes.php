<?php

namespace StarfolkSoftware\Levy\Contracts;

use StarfolkSoftware\Levy\Tax;

interface UpdatesTaxes
{
    /**
     * Update an existing tax.
     *
     * @param  mixed  $user
     * @param  \StarfolkSoftware\Levy\Tax  $tax
     * @param  array  $data
     * @return \StarfolkSoftware\Levy\Tax
     */
    public function __invoke($user, Tax $tax, array $data);
}
