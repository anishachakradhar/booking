<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExcelReport extends Model
{
    use SoftDeletes;

    public $table = 'excel_reports';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'dob_id',
        'name_id',
        'email_id',
        'phone_id',
        'module_id',
        'address_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'location_id',
        'conductor_id',
        'consultancy_name_id',
    ];

    public function name()
    {
        return $this->belongsTo(Student::class, 'name_id');
    }

    public function email()
    {
        return $this->belongsTo(Student::class, 'email_id');
    }

    public function phone()
    {
        return $this->belongsTo(Student::class, 'phone_id');
    }

    public function dob()
    {
        return $this->belongsTo(Student::class, 'dob_id');
    }

    public function address()
    {
        return $this->belongsTo(Student::class, 'address_id');
    }

    public function consultancy_name()
    {
        return $this->belongsTo(Student::class, 'consultancy_name_id');
    }

    public function location()
    {
        return $this->belongsTo(Student::class, 'location_id');
    }

    public function conductor()
    {
        return $this->belongsTo(Student::class, 'conductor_id');
    }

    public function module()
    {
        return $this->belongsTo(Student::class, 'module_id');
    }
}
