<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class baseModel extends Model
{

    protected $guarded = [''];

    protected $hidden = ['createdAt' , 'updatedAt'];

    public $timestamps = false;
}
