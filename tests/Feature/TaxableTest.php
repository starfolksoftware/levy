<?php

use StarfolkSoftware\Levy\Tax;
use StarfolkSoftware\Levy\Tests\Mocks\TestProduct;

beforeAll(function () {
    \StarfolkSoftware\Levy\Levy::resetTenantableOption();
});

it('can sync tax to a model', function () {
    $tax = Tax::factory()->create();

    list($product) = TestProduct::factory()->count(5)->create();

    $product->syncTaxes($tax);

    expect($product->taxes()->count())->toBe(1);

    expect($product->taxes()->first())
        ->id->toBe($tax->id)
        ->tenant_id->toBeNull()
        ->type->toBe($tax->type)
        ->name->toBe($tax->name)
        ->rate->toBe($tax->rate);

    // test that only one product has tax
    expect($product->hasTaxes($tax))->toBeTrue();
    expect($product->hasAllTaxes($tax))->toBeTrue();
    expect(TestProduct::withAllTaxes($tax)->count())->toBe(1);
    expect(TestProduct::withAnyTaxes($tax)->count())->toBe(1);
    expect(TestProduct::withoutTaxes($tax)->count())->toBe(4);
    expect(TestProduct::withoutAnyTaxes()->count())->toBe(4);
});

it('can attach and detach tax to a model', function () {
    list($tax1, $tax2, $tax3) = Tax::factory()->count(3)->create();

    list($product) = TestProduct::factory()->count(5)->create();

    $product->attachTaxes([$tax1->id, $tax2->id]);

    expect($product->taxes()->count())->toBe(2);

    expect(TestProduct::withoutTaxes($tax3)->count())->toBe(5);

    expect($product->taxes()->first())
        ->id->toBe($tax1->id)
        ->tenant_id->toBeNull()
        ->type->toBe($tax1->type)
        ->name->toBe($tax1->name)
        ->rate->toBe($tax1->rate);

    $product->detachTaxes($tax1);

    expect($product->taxes()->count())->toBe(1);

    expect(TestProduct::withAnyTaxes($tax2)->count())->toBe(1);

    $product->detachTaxes();

    expect($product->taxes()->count())->toBe(0);

    expect(TestProduct::withoutAnyTaxes()->count())->toBe(5);
});
