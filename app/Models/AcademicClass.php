<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'academic_classes';

    protected $fillable = ['name'];

    protected $hidden = ['created_at', 'updated_at'];

    public function departments():HasMany
    {
        return $this->hasMany(Department::class);
    }
}
