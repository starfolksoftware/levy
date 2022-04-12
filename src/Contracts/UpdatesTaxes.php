<?php

namespace StarfolkSoftware\Levy\Contracts;

interface UpdatesTaxes
{
    /**
     * Update an existing tax.
     *
     * @param  mixed  $user
     * @param  mixed  $tax
     * @param  array  $data
     * @return \StarfolkSoftware\Levy\Tax
     */
    public function __invoke($user, $tax, array $data);
}