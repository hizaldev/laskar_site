<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Induk extends Model
{
    use HasFactory, HasRoles, HasUuids, SoftDeletes;

    protected $fillable = [
        'induk',
        'code',
    ];

    public function User(){
        return $this->hasOne(User::class, 'user_id', 'id');
    }
}
