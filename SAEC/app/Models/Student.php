<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $primaryKey = "user_ci";

    protected $fillable = [
        "user_ci",
        "student_card_id",
        "student_enrollment_date"
    ];

    // Uno a uno (Un estudiante es un user)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_ci', 'user_ci');
    }

    // Muchos a muchos (Un estudiante tiene "se registra" en muchas secciones)
    public function sections() {
        return $this->belongsToMany(Section::class, 'sections_students', 'student_id', 'section_id')
            ->using(SectionStudent::class)
            ->withPivot('status')
            ->withTimestamps();

    }

    protected function casts()
    {
        return [
            'user_ci' => 'int',
            'student_card_id' => 'int'
        ];
    }
}
