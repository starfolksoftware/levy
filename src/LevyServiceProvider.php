<?php

namespace StarfolkSoftware\Levy;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use StarfolkSoftware\Levy\Commands\LevyCommand;

class LevyServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('levy')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_taxes_table')
            ->hasCommand(LevyCommand::class);
    }
}
