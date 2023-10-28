<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Attendance extends Model
{
    use HasFactory, HasRoles, Blameable, HasUuids, SoftDeletes;

    protected $fillable = [
        'agenda',
        'slug',
        'user_id',
        'tgl_agenda',
        'tempat',
        'is_public',
        'jam_mulai',
        'jam_berakhir',
        'is_selesai',
    ];

    public function attendance_detail()
    {
        return $this->hasMany(AttendanceDetail::class, 'attendance_id', 'id');
    }
}
