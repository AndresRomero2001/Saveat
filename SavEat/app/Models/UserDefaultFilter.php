<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDefaultFilter extends Model
{
    protected $fillable = [
        'user_id',
        'main_tag_id',
        'main_location_tag_id',
        'rating',
        'price_ranges',
        'tag_ids'
    ];

    protected $casts = [
        'rating' => 'decimal:1',
        'price_ranges' => 'array',
        'tag_ids' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mainTag()
    {
        return $this->belongsTo(Tag::class, 'main_tag_id');
    }

    public function mainLocationTag()
    {
        return $this->belongsTo(Tag::class, 'main_location_tag_id');
    }
}
