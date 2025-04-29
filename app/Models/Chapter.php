<?php

namespace App\Models;

use App\Models\Topic;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chapter extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'chapters';

    protected $fillable = ['subject_id', 'en_name', 'bn_name', 'chapter_order'];

    protected $hidden = ['created_at', 'updated_at'];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function topic(): HasMany
    {
        return $this->hasMany(Topic::class, 'chapter_id', 'id');
    }
}
