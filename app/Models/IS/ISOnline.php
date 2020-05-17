<?php

namespace App\Models\IS;

use Illuminate\Database\Eloquent\Model;

class ISOnline extends Model
{
    protected $connection = "mysql_is";
    protected $table = "is";

    protected $primaryKey = 'id';

    protected $guarded = [];

}
