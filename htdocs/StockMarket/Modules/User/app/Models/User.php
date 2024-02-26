<?php

namespace Modules\User\app\Models;

use App\Models\baseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Database\factories\UserFactory;

class User extends baseModel
{
    use HasFactory;

    public $table = 'Users';
}
