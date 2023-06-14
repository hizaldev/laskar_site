<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Dpd extends Model
{
    use HasFactory, HasRoles, SoftDeletes, Blameable, HasUuids;

    protected $table = 'dpd';

    protected $fillable =[
        'dpd',
        'alamat',
        'latitude',
        'longitude',
    ];

    public function dpc(){
        return $this->hasMany(Dpc::class, 'dpd_id', 'id');
    }
}
