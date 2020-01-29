<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AvailableDate extends Model
{
    use SoftDeletes;

    public $table = 'available_dates';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'available_date',
    ];

    protected $fillable = [
        'available_date',
        'available_date_id',
        'available_seat',
        'available_date_status',
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    public function dateBookDates()
    {
        return $this->hasMany(BookDate::class, 'available_date_id', 'available_date_id');
    }

    public function getAvailableDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setAvailableDateAttribute($value)
    {
        $this->attributes['available_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
