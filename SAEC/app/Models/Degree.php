<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    protected $fillable = [
        "school_id",
        "degree_name",
        "degree_minimun_credits"
    ];

    // Uno a Muchos (Una carrera tiene una escuela)
    public function school() {
        return $this->belongsToMany(Degree::class, 'degrees_subjects', 'degree_id', 'subject_id')
            ->using(DegreeSubject::class)
            ->withTimestamps();
    }

    // Muchos a Muchos (Una carrera tiene "ve" muchas materias)
    public function subjects() {
        return $this->belongsToMany(Subject::class);
    }

    protected function casts()
    {
        return [
            "degree_id" => 'int',
            "school_id" => 'int',
            "degree_minimun_credits" => 'int',
            "degree_name" => 'string'
        ];
    }
}
