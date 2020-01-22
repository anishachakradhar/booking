<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookDate extends Model
{
    use SoftDeletes;

    public $table = 'book_dates';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'book_date_id',
        'available_date_id',
        'student_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id','student_id');
    }

    public function date()
    {
        return $this->belongsTo(AvailableDate::class, 'available_date_id','available_date_id');
    }
}
