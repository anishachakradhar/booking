<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Student extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'students';

    protected $appends = [
        'passport_photo',
    ];

    protected $dates = [
        'dob',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const STATUS_SELECT = [
        'pending'      => 'Pending Approval',
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

    protected $fillable = [
        'dob',
        'name',
        'email',
        'phone',
        'status',
        'address',
        'created_at',
        'updated_at',
        'deleted_at',
        'passport_number',
        'location_id',
        'module_id',
        'conductor_id',
        'student_id',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    
    public function getDobAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getPassportPhotoAttribute()
    {
        $file = $this->getMedia('passport_photo')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'location_id');
    }
    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id', 'module_id');
    }
    public function conductor()
    {
        return $this->belongsTo(Conductor::class, 'conductor_id', 'conductor_id');
    }
    public function studentBookDate()
    {
        return $this->hasOne(BookDate::class, 'student_id', 'student_id');
    }
    public function getStatusNameAttribute()
    { 
        return self::STATUS_SELECT[$this->status];
    }
    public function payment()
    {
        return $this->hasOne(Payment::class,'student_id','student_id');
    }
}
