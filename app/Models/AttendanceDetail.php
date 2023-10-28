<?php

namespace App\Models;

use App\Blameable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class AttendanceDetail extends Model
{
    use HasFactory, HasRoles, HasUuids, SoftDeletes;

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d h:i:s');
    }


    protected $fillable = [
        'attendance_id',
        'user_id',
        'nama',
        'unit',
        'email',
        'no_tlp',
        'sign',
    ];
    public function kehadiran()
    {
        return $this->hasMany(Attendance::class, 'id', 'attendance_id');
    }
}
