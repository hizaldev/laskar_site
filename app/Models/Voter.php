<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Voter extends Model
{
    use HasFactory, HasRoles, SoftDeletes, Blameable, HasUuids;

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
    ];

    public function vote(){
        return $this->belongsTo(Vote::class);
    }

    public function vote_counter(){
        return $this->hasOne(VoteCounter::class, 'voter_id', 'id');
    }
}
