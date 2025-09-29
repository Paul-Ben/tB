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
        'guardian_address',
        'guardian_occupation',
        'guardian_relationship',
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
}
