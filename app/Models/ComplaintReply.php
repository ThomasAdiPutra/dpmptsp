<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ComplaintReply extends Model
{
    use HasFactory;

    protected $fillable = ['complaint_id', 'user_id', 'reply'];
    public $timestamps = true;

    /**
     * Get the complaint that owns the ComplaintReply
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }

    /**
     * Get the user that owns the ComplaintReply
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($reply) {
            $reply->user_id = Auth::user()->id;
        });
    }
}
