<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Student extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'age',
        'gender',
        'teacher_id',

    ];

    /**
     * DESCRIPTION : This Function return teacher
     * @Created by shineraj@protracked.in on (12 Jul 2022 at 3:45 PM)
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class,'teacher_id')->withTrashed();
    }
}
