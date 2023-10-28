<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegisterMembers extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'register_members';

    protected $fillable = [
        'no_pendaftaran',
        'unit_id',
        'golongan_darah',
        'jenis_kelamin',
        'nama_lengkap',
        'agama',
        'tempat_lahir',
        'no_telpon',
        'email',
        'size_id',
        'nipeg',
        'grade',
        'sign',
        'ip_address',
        'tgl_lahir',
        'tgl_masuk',
        'approval',
        'kode_refferal',
        'is_out_serikat',
        'union_id',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function serikat()
    {
        return $this->hasOne(Union::class, 'id', 'union_id');
    }

    public function member()
    {
        return $this->belongsTo(member::class);
    }
}
