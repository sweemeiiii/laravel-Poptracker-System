<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarcodeFigurine extends Model
{
    use HasFactory;

    protected $fillable = ['barcode', 'name', 'series', 'edition'];
}


