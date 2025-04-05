<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $fillable = [
        'name', 'color', 'level',
    ];

    // Soft Deletes
    use \Illuminate\Database\Eloquent\SoftDeletes;

    // Relations
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}