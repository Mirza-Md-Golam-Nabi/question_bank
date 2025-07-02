<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topic extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'topics';

    protected $fillable = ['chapter_id', 'name', 'topic_order'];

    protected $hidden = ['created_at', 'updated_at'];

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class, 'chapter_id', 'id');
    }
}
