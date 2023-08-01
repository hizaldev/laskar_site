<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class WhatsappGroup extends Model
{
    use HasFactory, HasRoles;

    protected $fillable =[
        'id',
        'group_name',
        'muted',
        'spam',
    ];
}
