<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Message extends Model
{
    protected $fillable = [
        'name', 'email', 'subject', 'message'
    ];

    protected $casts = [
        'is_read'  => 'boolean',
        'read_at'  => 'datetime',
    ];

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
}