<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'year_published',
        'edition',
        'isbn_10',
        'isbn_13',
        'height',
        'genre',
        'sub_genre',
    ];

    /**
     * Return the Authors of a book (Many-to-many)
     *
     * @return BelongsToMany
     */
    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }

    public function publishers(): BelongsToMany
    {
        return $this->belongsToMany(Publisher::class);
    }

    public function genres(): HasMany
    {
        return $this->hasMany(Genre::class);
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }
}
