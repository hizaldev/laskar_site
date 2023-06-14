<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logger extends Model
{
    use HasFactory, HasUuids;

    protected $table='logger';

    protected $fillable = [
        'user_id',
        'action',
        'module',
        'ip_address',
        'name',
        'data_log',
        'user_by',
        'created_at',
    ];
}
