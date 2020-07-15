<?php
namespace App\Models\IS;

use Illuminate\Database\Eloquent\Model;

class Lib_hospcode extends Model
{
    protected $connection = "mysql_is";
    protected $table = "lib_hospcode";
    protected $primaryKey = 'off_id';
    protected $guarded = [];

}
