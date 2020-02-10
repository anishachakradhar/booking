<?php

namespace App;

use App\BookDate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Payment extends Model
{
    use SoftDeletes, Notifiable;

    public $table = 'payments';

    public function routeNotificationForMail($notification)
    {
        return $this->payment->email;
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'book_date_id',
        'student_id',
        'payment_id',
        'type_id',
        'type_name',
        'status_id',
        'status_name',
        'amount',
        'fee_amount',
        'refund_status',
        'user_id',
        'user_name',
        'user_phone',
        'merchant_id',
        'merchant_name',
        'merchant_phone',
        'token',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function bookDatePayment()
    {
        return $this->belongsTo(BookDate::class, 'book_date_id', 'book_date_id');
    }
    public function payment()
    {
        return $this->belongsTo(Student::class,'student_id','student_id');
    }
}
