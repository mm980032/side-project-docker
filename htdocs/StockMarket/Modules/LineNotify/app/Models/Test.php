<?php

namespace Modules\LineNotify\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\LineNotify\Database\factories\TestFactory;

class Test extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): TestFactory
    {
        //return TestFactory::new();
    }
}
