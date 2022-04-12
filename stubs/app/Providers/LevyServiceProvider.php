<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use StarfolkSoftware\Levy\Actions\CreateTax;
use StarfolkSoftware\Levy\Actions\DeleteTax;
use StarfolkSoftware\Levy\Actions\UpdateTax;
use StarfolkSoftware\Levy\Levy;

class LevyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Levy::createTaxesUsing(CreateTax::class);

        Levy::updateTaxesUsing(UpdateTax::class);

        Levy::deleteTaxesUsing(DeleteTax::class);
    }
}