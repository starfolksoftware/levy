<?php

use StarfolkSoftware\Levy\Contracts\DeletesTaxes;
use StarfolkSoftware\Levy\Tax;
use StarfolkSoftware\Levy\Tests\Mocks\TestUser;

beforeAll(function () {
    \StarfolkSoftware\Levy\Levy::supportsTeams(false);
});

it('can delete a tax', function () {
    $deletesTaxes = app(DeletesTaxes::class);

    $user = TestUser::first();

    $tax = Tax::factory()->create();

    $deletesTaxes($user, $tax);

    expect(Tax::count())->toEqual(0);
});
