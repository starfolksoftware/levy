<?php

use StarfolkSoftware\Levy\Tax;
use StarfolkSoftware\Levy\Tests\Mocks\TestUser;

beforeAll(function () {
    \StarfolkSoftware\Levy\Levy::resetTenantableOption();
});

test('tax can be created', function () {
    $user = TestUser::first();

    $response = actingAs($user)->post(route('taxes.store'), [
        'type' => 'normal',
        'name' => 'Tax',
        'rate' => 7.5,
        'redirect' => '/redirect/path',
    ]);

    $response->assertRedirect('/redirect/path');

    $this->assertDatabaseHas('taxes', [
        'type' => 'normal',
        'name' => 'Tax',
        'rate' => 7.5,
    ]);
});

test('tax can be updated', function () {
    $user = TestUser::first();

    $tax = Tax::factory()->create();

    $response = actingAs($user)->put(route('taxes.update', $tax), [
        'type' => 'normal',
        'name' => 'Tax',
        'rate' => 7.5,
        'redirect' => '/redirect/path',
    ]);

    $response->assertRedirect('/redirect/path');

    $this->assertDatabaseHas('taxes', [
        'type' => 'normal',
        'name' => 'Tax',
        'rate' => 7.5,
    ]);
});

test('tax can be deleted', function () {
    $user = TestUser::first();

    $tax = Tax::factory()->create();

    $response = actingAs($user)->delete(route('taxes.destroy', $tax), [
        'redirect' => '/redirect/path',
    ]);

    $response->assertRedirect('/redirect/path');

    expect(Tax::count())->toEqual(0);
});
