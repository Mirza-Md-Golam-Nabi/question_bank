<?php

namespace App\Models;

use App\Models\Chapter;
use App\Models\Department;
use App\Models\AcademicClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'subjects';

    protected $fillable = ['class_id', 'department_id', 'name'];

    protected $hidden = ['created_at', 'updated_at'];

    public function academic_class(): BelongsTo
    {
        return $this->belongsTo(AcademicClass::class, 'class_id', 'id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function chapter(): HasMany
    {
        return $this->hasMany(Chapter::class, 'chapter_id', 'id');
    }
}
