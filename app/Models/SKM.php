<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SKM extends Model
{
    use HasFactory;

    protected $table = 'skm';
    protected $fillable = [
        'start_period',
        'end_period',
        'male',
        'female'
    ];

    /**
     * Get all of the result for the SKM
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function result()
    {
        return $this->hasMany(SKMResult::class, 'skm_id');
    }
}
