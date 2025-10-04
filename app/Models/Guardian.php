<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'guardian_name',
        'guardian_phone',
        'guardian_email',
        'address',
        'nationality',
        'image',
        'stateoforigin',
        'lga',
    ];

    /**
     * Get the user that owns the guardian.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the students for the guardian.
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    /**
     * Scope a query to search guardians by name, phone, or email.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('guardian_name', 'like', "%{$search}%")
              ->orWhere('guardian_phone', 'like', "%{$search}%")
              ->orWhere('guardian_email', 'like', "%{$search}%");
        });
    }

    /**
     * Scope a query to filter by nationality.
     */
    public function scopeByNationality($query, $nationality)
    {
        return $query->where('nationality', $nationality);
    }

    /**
     * Scope a query to filter by state of origin.
     */
    public function scopeByState($query, $state)
    {
        return $query->where('stateoforigin', $state);
    }
}
