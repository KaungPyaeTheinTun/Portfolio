<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Project extends Model
{
    protected $fillable = [
        'title', 'description', 'technologies',
        'screenshot', 'github_link', 'live_demo',
        'is_featured', 'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    // Return technologies as an array
    public function technologiesArray(): Attribute
    {
        return Attribute::make(
            get: fn() => explode(',', $this->technologies)
        );
    }

    // Get full screenshot URL
    public function screenshotUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->screenshot
                ? asset('storage/' . $this->screenshot)
                : asset('images/placeholder.png')
        );
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}