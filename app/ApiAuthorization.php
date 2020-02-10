<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiAuthorization extends Model
{
    public $table = 'api_authorizations';

    protected $dates = [
        'updated_at',
        'created_at',
    ];

    protected $fillable = [
        'username',
        'password',
        'updated_at',
        'created_at',
    ];

}
