<?php

namespace StarfolkSoftware\Levy\Contracts;

interface DeletesTaxes
{
    /**
     * Delete an existing tax.
     *
     * @param  mixed  $user
     * @param  mixed  $tax
     * @return void
     */
    public function __invoke($user, $tax);
}