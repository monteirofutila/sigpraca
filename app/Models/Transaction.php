<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = 'transactions';

    protected $fillable = [
        'code_number',
        'user_id',
        'account_id',
        'description',
        'amount',
        'previous_balance',
        'current_balance',
        'model_id',
        'model_type',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

}