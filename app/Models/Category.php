<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
        'payment_period',
        'debit_amount'
    ];

    public function account(): HasMany
    {
        return $this->hasMany(Account::class);
    }
}