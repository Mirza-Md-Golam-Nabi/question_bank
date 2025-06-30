<?php

namespace App\Models;

use App\Models\AcademicClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'departments';

    protected $fillable = ['academic_class_id', 'name'];

    protected $hidden = ['created_at', 'updated_at'];

    public function academic_class():BelongsTo
    {
        return $this->belongsTo(AcademicClass::class);
    }
}
