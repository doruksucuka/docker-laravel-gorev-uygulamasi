<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'is_completed',
        'user_id',
        'due_date', // ← bunu ekle
    ];

    protected $casts = [
        'due_date' => 'date',
    ];
}
