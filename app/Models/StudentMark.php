<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentMark extends Model
{
    use HasFactory,SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'maths',
        'science',
        'history',
        'term',
    ];

    protected $appends = ['total','created_on'];

    /**
     * DESCRIPTION : This Function return student
     * @Created by shineraj@protracked.in on (12 Jul 2022 at 3:45 PM)
     */
    public function student()
    {
        return $this->belongsTo(Student::class,'student_id')->withTrashed();
    }

    /**
     * DESCRIPTION : This Function return total
     * @return string
     * @Created by shineraj@protracked.in on (13 Jul 2022 at 6:34 PM)
     */
    public function getTotalAttribute()
    {
        return number_format($this->maths+$this->science + $this->history,2);
    }

    /**
     * DESCRIPTION : This Function return created on
     * @return string
     * @Created by shineraj@protracked.in on (13 Jul 2022 at 6:34 PM)
     */
    public function getCreatedOnAttribute()
    {
        return Carbon::parse($this->created_at)->format('M d, Y H:i A');
    }
}
