<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Term extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'name',
        'startDate',
        'endDate',
        'status',
    ];

    protected $casts = [
        'startDate' => 'date',
        'endDate' => 'date',
    ];

    /**
     * Get the school session that owns the term.
     */
    public function schoolSession(): BelongsTo
    {
        return $this->belongsTo(SchoolSession::class, 'session_id');
    }

    /**
     * Scope a query to search terms.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%");
    }

    /**
     * Scope a query to filter by status.
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
