<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Motor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_motor',
        'tentang_motor',
        'author',
    ];

    public function writer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}
