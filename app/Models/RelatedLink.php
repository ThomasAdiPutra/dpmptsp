<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RelatedLink extends Model
{
    use HasFactory;

    protected $fillable = ['logo', 'name', 'link', 'order'];
    public $timestamps = true;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($relatedLink) {
            $relatedLink->order = DB::table('related_links')->max('order')+1;
        });
    }
}
