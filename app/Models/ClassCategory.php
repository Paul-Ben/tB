<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'abbreviation',
    ];

    /**
     * A class category has many classrooms.
     */
    public function classrooms()
    {
        return $this->hasMany(Classroom::class, 'category_id');
    }

    /**
     * Scope a query to search categories by name or abbreviation.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('abbreviation', 'like', '%' . $search . '%');
        });
    }
}
