<?php

namespace StarfolkSoftware\Levy\Tests\Mocks;

use Illuminate\Database\Eloquent\Model;
use StarfolkSoftware\Levy\TenantHasTaxes;

class TenantModel extends Model
{
    use TenantHasTaxes;

    protected $table = 'tenants';
}
