<?php

use StarfolkSoftware\Levy\Contracts\CreatesTaxes;
use StarfolkSoftware\Levy\Levy;
use StarfolkSoftware\Levy\Tests\Mocks\TenantModel;
use StarfolkSoftware\Levy\Tests\Mocks\TestUser;

beforeAll(function () {
    Levy::resetTenantableOption();
});

it('can create a tax with multi-tenant support', function () {
    $tenant = TenantModel::forceCreate(['name' => 'Test Tenant']);

    Levy::tenantable();

    Levy::useTenantModel(TenantModel::class);

    $createsTaxes = app(CreatesTaxes::class);

    $user = TestUser::first();

    $tax = $createsTaxes(
        $user,
        [
            'type' => 'normal',
            'name' => 'Tax',
            'rate' => 7.5,
        ],
        $tenant->id,
    );

    expect($tax->refresh())
        ->type->toBe('normal')
        ->name->toBe('Tax')
        ->rate->toBe(7.5);

    expect($tax->refresh()->tenant)
        ->id->toBe($tenant->id)
        ->name->toBe('Test Tenant');

    expect($tenant->refresh()->taxes()->count())
        ->toBe(1);
});
