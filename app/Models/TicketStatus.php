<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    protected $fillable = [
        'name', 'description',
    ];

    // Relations
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}