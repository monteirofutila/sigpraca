<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Debit extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'debits';

    protected $fillable = [
        'account_id',
        'description',
        'amount',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'model');
    }
}