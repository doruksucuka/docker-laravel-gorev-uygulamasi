<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Category;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'is_completed',
        'user_id',
        'category_id',
        'due_date', // ← bunu ekle
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
