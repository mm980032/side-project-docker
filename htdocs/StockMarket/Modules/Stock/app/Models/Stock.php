<?php

namespace Modules\Stock\app\Models;

use App\Models\baseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends baseModel
{
    use HasFactory;

    public $table = 'Stock';

}
