<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VoterNotification extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table ='voters';

    protected $fillable = [
        'vote_id',
        'user_id',
        'no_anggota',
        'nama_lengkap',
        'dpd_id',
        'dpd',
        'dpc_id',
        'pass_key',
        'status_undangan',
        'tgl_kirim',
        'updated_at',
        'updated_by',
    ];
}
