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

    const MODULE_SELECT = [
        'academic' => 'IELTS Academic',
        'general'  => 'IELTS General Training',
    ];

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
        'module',
        'status',
        'address',
        'conductor',
        'created_at',
        'updated_at',
        'deleted_at',
        'location_id',
        'passport_number',
        'consultancy_name',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function nameExcelReports()
    {
        return $this->hasMany(ExcelReport::class, 'name_id', 'id');
    }

    public function emailExcelReports()
    {
        return $this->hasMany(ExcelReport::class, 'email_id', 'id');
    }

    public function phoneExcelReports()
    {
        return $this->hasMany(ExcelReport::class, 'phone_id', 'id');
    }

    public function dobExcelReports()
    {
        return $this->hasMany(ExcelReport::class, 'dob_id', 'id');
    }

    public function studentsEmailBookDates()
    {
        return $this->hasMany(BookDate::class, 'students_email_id', 'id');
    }

    public function addressExcelReports()
    {
        return $this->hasMany(ExcelReport::class, 'address_id', 'id');
    }

    public function consultancyNameExcelReports()
    {
        return $this->hasMany(ExcelReport::class, 'consultancy_name_id', 'id');
    }

    public function locationExcelReports()
    {
        return $this->hasMany(ExcelReport::class, 'location_id', 'id');
    }

    public function conductorExcelReports()
    {
        return $this->hasMany(ExcelReport::class, 'conductor_id', 'id');
    }

    public function moduleExcelReports()
    {
        return $this->hasMany(ExcelReport::class, 'module_id', 'id');
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
        return $this->belongsTo(Location::class, 'location_id');
    }
}
