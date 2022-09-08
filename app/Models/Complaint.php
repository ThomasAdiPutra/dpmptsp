<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'alamat', 'no_hp', 'judul_aduan', 'isi_aduan'];
    public $timestamps = true;

    public function scopeActive($query)
    {
        return $query->where('active', '1');
    }

    /**
     * Get all of the reply for the Complaint
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reply()
    {
        return $this->hasMany(ComplaintReply::class);
    }

    public function toggleActive()
    {
        if ($this->active === '1') {
            $this->active = '0';
        } else {
            $this->active = '1';
        }
        return $this->save();
    }
}
