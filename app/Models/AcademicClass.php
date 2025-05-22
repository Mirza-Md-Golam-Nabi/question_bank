<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'academic_classes';

    protected $fillable = ['name'];

    protected $hidden = ['created_at', 'updated_at'];
}
