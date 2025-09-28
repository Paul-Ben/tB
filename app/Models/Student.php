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
}
