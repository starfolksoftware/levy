<?php

namespace StarfolkSoftware\Levy;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as BaseCollection;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Taxable
{
    /**
     * Define a polymorphic many-to-many relationship.
     *
     * @param string $related
     * @param string $name
     * @param string $table
     * @param string $foreignPivotKey
     * @param string $relatedPivotKey
     * @param string $parentKey
     * @param string $relatedKey
     * @param bool   $inverse
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    abstract public function morphToMany(
        $related,
        $name,
        $table = null,
        $foreignPivotKey = null,
        $relatedPivotKey = null,
        $parentKey = null,
        $relatedKey = null,
        $inverse = false
    );

    /**
     * Get all attached taxes to the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function taxes(): MorphToMany
    {
        return $this->morphToMany(
            Levy::$taxModel, 
            'taxable', 
            'taxables', 
            'taxable_id', 
            'tax_id'
        )->withTimestamps();
    }

    /**
     * Scope query with all the given taxes.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param mixed $taxes
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithAllTaxes(Builder $builder, $taxes): Builder
    {
        $taxes = $this->prepareTaxIds($taxes);

        collect($taxes)->each(function ($tax) use ($builder) {
            $builder->whereHas('taxes', function (Builder $builder) use ($tax) {
                return $builder->where('id', $tax);
            });
        });

        return $builder;
    }

    /**
     * Scope query with any of the given taxes.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param mixed $taxes
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithAnyTaxes(Builder $builder, $taxes): Builder
    {
        $taxes = $this->prepareTaxIds($taxes);

        return $builder->whereHas('taxes', function (Builder $builder) use ($taxes) {
            $builder->whereIn('id', $taxes);
        });
    }

    /**
     * Scope query without any of the given taxes.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param mixed $taxes
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithoutTaxes(Builder $builder, $taxes): Builder
    {
        $taxes = $this->prepareTaxIds($taxes);

        return $builder->whereDoesntHave('taxes', function (Builder $builder) use ($taxes) {
            $builder->whereIn('id', $taxes);
        });
    }

    /**
     * Scope query without any taxes.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithoutAnyTaxes(Builder $builder): Builder
    {
        return $builder->doesntHave('taxes');
    }

    /**
     * Determine if the model has any of the given taxes.
     *
     * @param mixed $taxes
     * @return bool
     */
    public function hasTaxes($taxes): bool
    {
        $taxes = $this->prepareTaxIds($taxes);

        return ! $this->taxes->pluck('id')->intersect($taxes)->isEmpty();
    }

    /**
     * Determine if the model has all of the given taxes.
     *
     * @param mixed $taxes
     * @return bool
     */
    public function hasAllTaxes($taxes): bool
    {
        $taxes = $this->prepareTaxIds($taxes);

        return collect($taxes)->diff($this->taxes->pluck('id'))->isEmpty();
    }


    /**
     * Sync model taxes.
     *
     * @param mixed $taxes
     * @param bool  $detaching
     * @return $this
     */
    public function syncTaxes($taxes, bool $detaching = true)
    {
        // Find taxes
        $taxes = $this->prepareTaxIds($taxes);

        // Sync model taxes
        $this->taxes()->sync($taxes, $detaching);

        return $this;
    }

    /**
     * Attach model taxes.
     *
     * @param mixed $taxes
     * @return $this
     */
    public function attachTaxes($taxes)
    {
        return $this->syncTaxes($taxes, false);
    }

    /**
     * Detach model taxes.
     *
     * @param mixed $taxes
     * @return $this
     */
    public function detachTaxes($taxes = null)
    {
        $taxes = ! is_null($taxes) ? $this->prepareTaxIds($taxes) : null;

        // Sync model taxes
        $this->taxes()->detach($taxes);

        return $this;
    }

    /**
     * Prepare tax IDs.
     *
     * @param mixed $taxes
     * @return array
     */
    protected function prepareTaxIds($taxes): array
    {
        // Convert collection to plain array
        if ($taxes instanceof BaseCollection && is_string($taxes->first())) {
            $taxes = $taxes->toArray();
        }

        // Find taxes by their ids
        if (is_numeric($taxes) || (is_array($taxes) && is_numeric(Arr::first($taxes)))) {
            return array_map('intval', (array) $taxes);
        }

        if ($taxes instanceof Model) {
            return [$taxes->getKey()];
        }

        if ($taxes instanceof Collection) {
            return $taxes->modelKeys();
        }

        if ($taxes instanceof BaseCollection) {
            return $taxes->toArray();
        }

        return (array) $taxes;
    }
}