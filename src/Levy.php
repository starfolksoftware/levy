<?php

namespace StarfolkSoftware\Levy;

use StarfolkSoftware\Levy\Contracts\CreatesTaxes;
use StarfolkSoftware\Levy\Contracts\DeletesTaxes;
use StarfolkSoftware\Levy\Contracts\UpdatesTaxes;

class Levy
{
    /**
     * Indicates if Levy routes will be registered.
     *
     * @var bool
     */
    public static $registersRoutes = true;

    /**
     * Indicates if Levy migrations should be ran.
     *
     * @var bool
     */
    public static $runsMigrations = true;

    /**
     * The tax model that should be used by Levy.
     *
     * @var string
     */
    public static $taxModel = 'StarfolkSoftware\\Levy\\Tax';

    /**
     * Indicates if Levy should support teams.
     *
     * @var bool
     */
    public static $supportsTeams = false;

    /**
     * The tenant model that should be used by Levy.
     *
     * @var string
     */
    public static $TeamModel;

    /**
     * The callback to perform additional validation when creating new tax.
     *
     * @var callable
     */
    public static $validateTaxCreation;

    /**
     * The callback to perform additional validation when updating a tax.
     *
     * @var callable
     */
    public static $validateTaxUpdate;

    /**
     * The callback to perform additional validation when deleting a tax.
     *
     * @var callable
     */
    public static $validateTaxDeletion;

    /**
     * Get the name of the tax model used by the application.
     *
     * @return string
     */
    public static function TeamModel()
    {
        return static::$TeamModel;
    }

    /**
     * Specify the tenant model that should be used by Levy.
     *
     * @param  string  $model
     * @return static
     */
    public static function useTeamModel(string $model)
    {
        static::$TeamModel = $model;

        return new static();
    }

    /**
     * Get a new instance of the tenant model.
     *
     * @return mixed
     */
    public static function newTeamModel()
    {
        $model = static::TeamModel();

        return new $model();
    }

    /**
     * Find a tenant instance by the given ID.
     *
     * @param  mixed  $id
     * @return mixed
     */
    public static function findTenantByIdOrFail($id)
    {
        return static::newTeamModel()->whereId($id)->firstOrFail();
    }

    /**
     * Get the name of the tax model used by the application.
     *
     * @return string
     */
    public static function taxModel()
    {
        return static::$taxModel;
    }

    /**
     * Get a new instance of the tax model.
     *
     * @return mixed
     */
    public static function newTaxModel()
    {
        $model = static::taxModel();

        return new $model();
    }

    /**
     * Specify the tax model that should be used by Levy.
     *
     * @param  string  $model
     * @return static
     */
    public static function useTaxModel(string $model)
    {
        static::$taxModel = $model;

        return new static();
    }

    /**
     * Register a class / callback that should be used to create taxes.
     *
     * @param  string  $class
     * @return void
     */
    public static function createTaxesUsing(string $class)
    {
        return app()->singleton(CreatesTaxes::class, $class);
    }

    /**
     * Register a class / callback that should be used to validate tax creation.
     *
     * @param  callable  $callback
     * @return void
     */
    public static function validateTaxCreationUsing(callable $callback)
    {
        static::$validateTaxCreation = $callback;
    }

    /**
     * Register a class / callback that should be used to update taxes.
     *
     * @param  string  $class
     * @return void
     */
    public static function updateTaxesUsing(string $class)
    {
        return app()->singleton(UpdatesTaxes::class, $class);
    }

    /**
     * Register a class / callback that should be used to validate tax update.
     *
     * @param  callable  $callback
     * @return void
     */
    public static function validateTaxUpdateUsing(callable $callback)
    {
        static::$validateTaxUpdate = $callback;
    }

    /**
     * Register a class / callback that should be used to delete taxes.
     *
     * @param  string  $class
     * @return void
     */
    public static function deleteTaxesUsing(string $class)
    {
        return app()->singleton(DeletesTaxes::class, $class);
    }

    /**
     * Register a class / callback that should be used to validate tax deletion.
     *
     * @param  callable  $callback
     * @return void
     */
    public static function validateTaxDeletionUsing(callable $callback)
    {
        static::$validateTaxDeletion = $callback;
    }

    /**
     * Configure Levy to not register its routes.
     *
     * @return static
     */
    public static function ignoreRoutes()
    {
        static::$registersRoutes = false;

        return new static();
    }

    /**
     * Configure Levy to not run its migrations.
     *
     * @return static
     */
    public static function ignoreMigrations()
    {
        static::$runsMigrations = false;

        return new static();
    }

    /**
     * Configure Levy to support multiple tenants.
     *
     * @param  bool  $value
     * @return static
     */
    public static function supportsTeams(bool $value = true)
    {
        static::$supportsTeams = $value;

        return new static();
    }

    /**
     * Get a completion redirect path for a specific feature.
     *
     * @param  string  $redirect
     * @return string
     */
    public static function redirects(string $redirect, $default = null)
    {
        return config('levy.redirects.'.$redirect) ?? $default ?? '/';
    }
}
