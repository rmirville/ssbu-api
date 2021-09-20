<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class StageClassification extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    // protected $primaryKey = 'gameName';
    // protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
}
