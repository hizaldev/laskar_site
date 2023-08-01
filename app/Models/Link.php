<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Link extends Model
{
    use HasFactory, SoftDeletes, HasUuids, Blameable, HasRoles;

    protected $fillable = [
        'nama_link',
        'initial',
        'link',
        'icons',
        'is_aktif',
        'image',
    ];
}
