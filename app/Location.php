<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;

    public $table = 'locations';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'location',
        'location_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function locationStudents()
    {
        return $this->hasMany(Student::class, 'location_id', 'location_id');
    }
}
