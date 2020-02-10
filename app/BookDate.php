<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookDate extends Model
{
    use SoftDeletes;

    public $table = 'book_dates';

    const STATUS_SELECT = [
        'pending'      => 'Pending',
        'date_booked'     => 'Date Booked',
        'changed_date' => 'Changed Date',
        'awaiting_consultancy_confirmation' => 'Awaiting Consultancy Confirmation',
        'awaiting_date_booking' =>  'Awaiting Date Booking',
        'booking_held'  =>  'Booking Held',
        'awaiting_refund'   =>  'Awaiting Refund',
        'refunded'  =>  'Refunded',
        'processing_refund' =>  'Processing Refund',
        'cancelled'    => 'Cancelled',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'book_date_id',
        'available_date_id',
        'payment_status',
        'book_date_status',
        'temp_booking_code',
        'permanent_booking_code',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function student()
    {
        return $this->hasOne(Student::class, 'book_date_id','book_date_id');
    }

    public function date()
    {
        return $this->belongsTo(AvailableDate::class, 'available_date_id','available_date_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'book_date_id','book_date_id');
    }

    public function getStatusNameAttribute()
    { 
        return self::STATUS_SELECT[$this->book_date_status];
    }
}
