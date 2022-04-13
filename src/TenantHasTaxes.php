<?php

namespace StarfolkSoftware\Levy;

trait TenantHasTaxes
{
    /**
     * Get the taxes associated with the tenant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function taxes()
    {
        return $this->hasMany(Levy::$taxModel, 'tenant_id');
    }
}
