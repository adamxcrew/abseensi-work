<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'employee_id',
        'submission_type',
        'start_timeoff',
        'finish_timeoff',
        'submission_desc',
        'submission_file',
        'submission_status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
            $model->created_at = now();
        });

        static::updating(function ($model) {
            $model->updated_at = now();
        });
    }

    public function employee()
    {
        return $this->belongsTo(EmployeeProfile::class, 'employee_id', 'id');
    }

    public function timeoff()
    {
        return $this->belongsTo(TimeOffSetting::class, 'submission_type', 'id');
    }
}
