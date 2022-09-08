<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['icon', 'name', 'description', 'detail'];
    public $timestamps = true;

    /**
     * Get all of the permission for the Service
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permission()
    {
        return $this->hasMany(ServicePermission::class);
    }

    public function permissionForm()
    {
        return $this->hasMany(ServicePermissionForm::class);
    }

    public function scopeFindBySlug($query, $name)
    {
        return $query->where('name', str_replace('-', ' ', $name));
    }
}
