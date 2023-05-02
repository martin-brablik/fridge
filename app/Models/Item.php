<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Item extends Model
{
    use HasFactory;

    protected $table = 'item';

    protected $fillable = ['name', 'dv', 'dn', 'dmt', 'ds', 'ps'];

    protected $name;
    protected $dv;
    protected $dn;
    protected $dmt;
    protected $ds;
    protected $ps;
}
