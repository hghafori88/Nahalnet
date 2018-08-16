<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'name', 'address', 'course_id','time','section','quality',
    ];
    public function courses()
    {
        return $this->belongsTo(Course::class);
    }
}
