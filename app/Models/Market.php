<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Market extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'markets';

    protected $fillable = [
        'name',
        'address',
        'description'
    ];

    public function workers(): BelongsToMany
    {
        return $this->belongsToMany(Worker::class);
    }
}
