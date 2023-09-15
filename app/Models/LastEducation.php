<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class LastEducation extends Model
{
    use HasFactory, HasRoles, HasUuids, Blameable, SoftDeletes;

    protected $table ='last_educations';

    protected $fillable = [
        'pendidikan_terakhir',
        'keterangan',
    ];
}
