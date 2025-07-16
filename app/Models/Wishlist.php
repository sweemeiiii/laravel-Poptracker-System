<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'figurine_id'];

    protected $table = 'wishlists'; // Ensure this matches your table name

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function figurine()
    {
        return $this->belongsTo(Figurine::class);
    }
}

