<?php

namespace StarfolkSoftware\Levy\Tests\Mocks;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use StarfolkSoftware\Levy\Taxable;

class TestProduct extends Model
{
    use HasFactory;
    use Taxable;

    protected $table = 'products';
}
