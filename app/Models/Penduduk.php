<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Foundation\Auth\User as Model;

class Penduduk extends Model
{
    use HasFactory;
    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $guarded=[];

}
