<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use SoftDeletes;

    public $table = 'modules';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'module',
        'module_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function moduleStudents()
    {
        return $this->hasMany(Student::class, 'module_id', 'module_id');
    }
}
