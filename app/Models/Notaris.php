<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notaris extends Model
{
    use SoftDeletes;
    protected $table = "notaris";
    protected $fillable = ['name','no_hp'];

}
