<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conductor extends Model
{
    use SoftDeletes;

    public $table = 'conductors';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'conductor',
        'conductor_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function conductorStudents()
    {
        return $this->hasMany(Student::class, 'conductor_id', 'conductor_id');
    }
}
