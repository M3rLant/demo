<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'cost',
        'user_id',
        'tour_id',
    ];

    // Связь с моделью Tour
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    // Связь с моделью User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}