<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'gender_id',
        'title',
        'isbn',
        'pages',
        'stock',
        'published_at',
    ];

    public function casts(): array
    {
        return [
            'published_at' => 'date:Y-m-d',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }
}
