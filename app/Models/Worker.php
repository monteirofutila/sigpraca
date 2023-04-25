<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $table = 'workers';

    protected $fillable = [
        'name',
        'email',
        'photo',
        'phone_mobile',
        'phone_other',
        'address_country',
        'address_state',
        'address_city',
        'address_street',
        'date_birth',
        'gender',
        'bi',
    ];
}
