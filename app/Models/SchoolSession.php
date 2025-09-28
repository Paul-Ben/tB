<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'sessionName',
        'status'
    ];

    protected $casts = [
        'status' => 'string'
    ];

    /**
     * Scope to get active sessions
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope to get inactive sessions
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    /**
     * Check if session is active
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Get the status badge class for UI
     */
    public function getStatusBadgeClass()
    {
        return $this->status === 'active' ? 'bg-success' : 'bg-secondary';
    }
}
