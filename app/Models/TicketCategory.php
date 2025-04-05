<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
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