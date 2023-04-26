<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worker extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

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

    public function account(): HasOne
    {
        return $this->hasOne(Account::class);
    }

    public function market(): BelongsTo
    {
        return $this->belongsTo(Worker::class);
    }
}
