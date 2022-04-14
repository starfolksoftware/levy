<?php

namespace StarfolkSoftware\Levy;

trait TeamHasTaxes
{
    /**
     * Get the taxes associated with the tenant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function taxes()
    {
        return $this->hasMany(Levy::$taxModel, 'team_id');
    }
}
