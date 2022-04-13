<?php

use StarfolkSoftware\Levy\Contracts\CreatesTaxes;
use StarfolkSoftware\Levy\Tests\Mocks\TestUser;

beforeAll(function () {
    \StarfolkSoftware\Levy\Levy::resetTenantableOption();
});

it('can create a tax', function () {
    $createsTaxes = app(CreatesTaxes::class);

    $user = TestUser::first();

    $tax = $createsTaxes(
        $user, [
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
