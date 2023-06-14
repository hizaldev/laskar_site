<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class TypeBlood extends Model
{
    use HasFactory, SoftDeletes, HasRoles, Blameable, HasUuids;

    protected $table = 'type_bloods';

    protected $fillable = [
        'golongan_darah',
        'description',
    ];
}
