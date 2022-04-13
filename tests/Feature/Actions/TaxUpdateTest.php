<?php

use StarfolkSoftware\Levy\Contracts\UpdatesTaxes;
use StarfolkSoftware\Levy\Tax;
use StarfolkSoftware\Levy\Tests\Mocks\TestUser;

beforeAll(function () {
    \StarfolkSoftware\Levy\Levy::resetTenantableOption();
});

it('can update a tax', function () {
    $updatesTaxes = app(UpdatesTaxes::class);

    $user = TestUser::first();

    $tax = Tax::factory()->create();

    $tax = $updatesTaxes(
        $user,
        $tax,
        [
            'type' => 'normal',
            'name' => 'Tax',
            'rate' => 7.5,
        ]
    );

    expect($tax->refresh())
        ->type->toBe('normal')
        ->name->toBe('Tax')
        ->rate->toBe(7.5);
});
