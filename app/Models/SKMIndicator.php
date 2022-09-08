<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SKMIndicator extends Model
{
    use HasFactory;

    protected $table = 'skm_indicators';
    protected $fillable = [
        'question'
    ];

    /**
     * Get all of the result for the SKMIndicator
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function result()
    {
        return $this->hasMany(SKMResult::class, 'skm_indicator_id');
    }
}
