<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $table = 'SFCCTLEMP';
    protected $fillable = ['SCC12_EMPNO', 'SCC12_DEPTNM','SCC12_LINENM'];
}
