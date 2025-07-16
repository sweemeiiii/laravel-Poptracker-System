<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duplicate extends Model
{
    use HasFactory;

    protected $table = 'duplicates'; // Specify the table name explicitly
    protected $fillable = ['user_id', 'figurine_id'];

    public function figurine()
    {
        return $this->belongsTo(Figurine::class);
    }
}
