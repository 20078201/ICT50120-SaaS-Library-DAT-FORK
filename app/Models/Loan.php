<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [

    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function books(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
