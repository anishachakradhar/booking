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

    const CONDUCTOR_SELECT = [
        'bc'  => 'British Council',
        'idp' => 'IDP',
    ];

    // const MODULE_SELECT = [
    //     'academic' => 'IELTS Academic',
    //     'general'  => 'IELTS General Training',
    // ];

    const STATUS_SELECT = [
        'pending'      => 'Pending',
        'approved'     => 'Approved',
        'cancelled'    => 'Cancelled',
        'changed_date' => 'Changed Date',
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
        'consultancy_name',
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
}
