<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePermission extends Model
{
    use HasFactory;

    protected $fillable = ['service_id', 'name', 'requirement'];
    public $timestamps = true;

    /**
     * Get the service that owns the ServicePermission
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
