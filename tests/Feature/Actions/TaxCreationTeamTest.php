<?php

use StarfolkSoftware\Levy\Contracts\CreatesTaxes;
use StarfolkSoftware\Levy\Levy;
use StarfolkSoftware\Levy\Tests\Mocks\TeamModel;
use StarfolkSoftware\Levy\Tests\Mocks\TestUser;

beforeAll(function () {
    Levy::supportsTeams(false);
});

it('can create a tax with team support', function () {
    $team = TeamModel::forceCreate(['name' => 'Test Team']);

    Levy::supportsTeams();

    Levy::useTeamModel(TeamModel::class);

    $createsTaxes = app(CreatesTaxes::class);

    $user = TestUser::first();

    $tax = $createsTaxes(
        $user,
        [
            'type' => 'normal',
            'name' => 'Tax',
            'rate' => 7.5,
        ],
        $team->id,
    );

    expect($tax->refresh())
        ->type->toBe('normal')
        ->name->toBe('Tax')
        ->rate->toBe(7.5);

    expect($tax->refresh()->team)
        ->id->toBe($team->id)
        ->name->toBe('Test Team');

    expect($team->refresh()->taxes()->count())
        ->toBe(1);
});
