<?php

namespace StarfolkSoftware\Levy\Contracts;

interface CreatesTaxes
{
    /**
     * Create a new tax.
     *
     * @param  mixed  $user
     * @param  array  $data
     * @param  mixed  $teamId
     * @return \StarfolkSoftware\Levy\Tax
     */
    public function __invoke($user, array $data, $teamId = null);
}
