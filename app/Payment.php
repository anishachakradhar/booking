<?php

namespace App;

use App\BookDate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    public $table = 'payments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'book_date_id',
        'status',
        'payment_id',
        'transaction_id',
        'amount',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function bookDatePayment()
    {
        return $this->belongsTo(BookDate::class, 'book_date_id', 'book_date_id');
    }
}
