<?php

namespace StarfolkSoftware\Levy;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use StarfolkSoftware\Levy\Actions\CreateTax;
use StarfolkSoftware\Levy\Actions\DeleteTax;
use StarfolkSoftware\Levy\Actions\UpdateTax;
use StarfolkSoftware\Levy\Commands\InstallCommand;

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
            ->hasCommand(InstallCommand::class);

        if (Levy::$runsMigrations) {
            $package->hasMigration('create_taxes_table');
        }

        if (Levy::$registersRoutes) {
            $package->hasRoutes('web');
        }
    }

    public function packageRegistered()
    {
        Levy::createTaxesUsing(CreateTax::class);

        Levy::updateTaxesUsing(UpdateTax::class);

        Levy::deleteTaxesUsing(DeleteTax::class);
    }
}
