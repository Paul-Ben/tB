<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'std_number',
        'date_of_birth',
        'image',
        'nationality',
        'gender',
        'stateoforigin',
        'lga',
        'genotype',
        'bgroup',
        'guardian_id',
        'class_id',
        'current_session',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * Get the guardian that owns the student.
     */
    public function guardian()
    {
        return $this->belongsTo(Guardian::class);
    }

    /**
     * Get the classroom that the student belongs to.
     */
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

    /**
     * Get the school session for the student.
     */
    public function schoolSession()
    {
        return $this->belongsTo(SchoolSession::class, 'current_session');
    }

    /**
     * Get the full name of the student.
     */
    public function getFullNameAttribute()
    {
        return trim($this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name);
    }

    /**
     * Scope a query to search students by name, student number, or guardian name.
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('middle_name', 'like', "%{$search}%")
                  ->orWhere('std_number', 'like', "%{$search}%")
                  ->orWhereHas('guardian', function ($guardianQuery) use ($search) {
                      $guardianQuery->where('guardian_name', 'like', "%{$search}%");
                  });
            });
        }
        return $query;
    }

    /**
     * Scope a query to filter students by classroom.
     */
    public function scopeByClassroom($query, $classroomId)
    {
        if ($classroomId) {
            return $query->where('class_id', $classroomId);
        }
        return $query;
    }

    /**
     * Scope a query to filter students by gender.
     */
    public function scopeByGender($query, $gender)
    {
        if ($gender) {
            return $query->where('gender', $gender);
        }
        return $query;
    }

    /**
     * Scope a query to filter students by nationality.
     */
    public function scopeByNationality($query, $nationality)
    {
        if ($nationality) {
            return $query->where('nationality', $nationality);
        }
        return $query;
    }

    /**
     * Scope a query to filter students by school session.
     */
    public function scopeBySession($query, $sessionId)
    {
        if ($sessionId) {
            return $query->where('current_session', $sessionId);
        }
        return $query;
    }
}
