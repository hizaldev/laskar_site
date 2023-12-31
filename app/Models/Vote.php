<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Vote extends Model
{
    use HasFactory, HasRoles, SoftDeletes, Blameable, HasUuids;

    protected $fillable = [
        'judul_pemilihan',
        'deskripsi',
        'status',
        'tgl_vote_mulai',
        'tgl_vote_berakhir',
    ];

    public function voter(){
        return $this->hasMany(Voter::class, 'vote_id', 'id');
    }

    public function vote_counter(){
        return $this->hasMany(VoteCounter::class, 'vote_id', 'id');
    }
}
