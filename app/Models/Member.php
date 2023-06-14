<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Member extends Model
{
    use HasFactory, HasRoles, HasUuids, SoftDeletes;

    protected $fillable = [
        'unit_id',
        'no_anggota',
        'no_pendaftaran',
        'golongan_darah',
        'jenis_kelamin',
        'nama_lengkap',
        'agama',
        'alamat',
        'tempat_lahir',
        'no_telpon',
        'email',
        'size_id',
        'nipeg',
        'grade',
        'sign',
        'ip_address',
        'tgl_lahir',
        'dpd_id',
        'dpc_id',
        'status_id',
        'bank_id',
        'no_rekening',
        'is_dpp',
        'tgl_anggota',
        'tgl_pendaftaran',
    ];

    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    public function size(){
        return $this->belongsTo(Size::class);
    }

    public function status(){
        return $this->belongsTo(StatusMember::class);
    }
    public function dpd(){
        return $this->belongsTo(Dpd::class);
    }
    public function dpc(){
        return $this->belongsTo(Dpc::class);
    }
    public function bank(){
        return $this->belongsTo(Bank::class);
    }
}
