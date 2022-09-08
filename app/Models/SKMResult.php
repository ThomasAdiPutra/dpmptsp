<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SKMResult extends Model
{
    use HasFactory;

    protected $table = 'skm_results';
    protected $fillable = [
        'skm_id',
        'skm_indicator_id',
        'score'
    ];

    /**
     * Get the skm that owns the SKMResult
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function skm()
    {
        return $this->belongsTo(SKM::class, 'skm_id');
    }

    /**
     * Get the indicator that owns the SKMResult
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function indicator()
    {
        return $this->belongsTo(SKMIndicator::class, 'skm_indicator_id');
    }
}
