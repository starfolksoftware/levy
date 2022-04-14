<?php

namespace StarfolkSoftware\Levy\Tests\Mocks;

use Illuminate\Database\Eloquent\Model;
use StarfolkSoftware\Levy\TeamHasTaxes;

class TeamModel extends Model
{
    use TeamHasTaxes;

    protected $table = 'teams';
}
