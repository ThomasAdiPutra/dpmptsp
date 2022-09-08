<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'category_id', 'thumbnail', 'title', 'content'];
    public $timestamps = true;

    public function scopeActive($query)
    {
        return $query->where('active', '1');
    }

    public function incrementViews()
    {
        $this->views++;
        return $this->save();
    }

    public function toggleActive()
    {
        if ($this->active == '0')
        {
            $this->active = '1';
        }
        else {
            $this->active = '0';
        }
        return $this->save();
    }

    /**
     * Get the user that owns the News
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the News
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($news) {
            $news->user_id = Auth::user()->id??1;
            $news->slug = Str::slug($news->title.'-'.date('d m y'));
        });
    }
}
