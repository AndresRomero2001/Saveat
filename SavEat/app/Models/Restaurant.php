<?php

namespace App\Models;

use App\Enums\PriceRange;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'main_tag_id',
        'main_location_tag_id',
        'price_range',
        'rating',
        'description'
    ];

    protected $casts = [
        'price_range' => PriceRange::class,
        'rating' => 'float'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function mainTag(): BelongsTo
    {
        return $this->belongsTo(Tag::class, 'main_tag_id');
    }

    public function mainLocationTag(): BelongsTo
    {
        return $this->belongsTo(Tag::class, 'main_location_tag_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
