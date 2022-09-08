<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePermissionForm extends Model
{
    use HasFactory;
    protected $fillable = ['service_id', 'name', 'form'];
    public $timestamps = true;
    /**
     * Get the service that owns the ServicePermissionForm
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
