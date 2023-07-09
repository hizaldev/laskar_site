<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class VoteCounter extends Model
{
    use HasFactory, SoftDeletes, HasRoles, HasUuids;

    protected $fillable =[
        'vote_id',
        'voter_id',
        'candidate_id',
        'ip_address',
        'created_by',
        'updated_by',
    ];

    public function vote(){
        return $this->belongsTo(Vote::class);
    }

    public function voter(){
        return $this->belongsTo(Voter::class);
    }
}
