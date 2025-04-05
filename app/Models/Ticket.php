<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'title', 'description', 'user_id', 'assigned_to', 'department_id',
        'category_id', 'priority_id', 'status_id', 'resolved_at',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function category()
    {
        return $this->belongsTo(TicketCategory::class);
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function status()
    {
        return $this->belongsTo(TicketStatus::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}