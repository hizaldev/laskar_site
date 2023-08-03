<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Union extends Model
{
    use HasFactory, SoftDeletes, Blameable, HasUuids, HasRoles;

    protected $fillable =[
        'serikat_pekerja',
        'alamat',
        'latitude',
        'longitude',
    ];
}
