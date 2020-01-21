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
        'date_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'students_email_id',
    ];

    public static function boot()
    {
        parent::boot();

        BookDate::observe(new \App\Observers\BookDateActionObserver);
    }

    public function students_email()
    {
        return $this->belongsTo(Student::class, 'students_email_id');
    }

    public function date()
    {
        return $this->belongsTo(AvailableDate::class, 'date_id');
    }
}
