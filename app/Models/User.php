<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_id',
        'nipeg',
        'induk_id',
        'dpd_id',
        'dpc_id',
        'unit_id',
        'alamat',
        'is_dpp',
        'status',
        'tipe_akun',
        'fcm_token',
        'keterangan',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function member(){
        return $this->belongsTo(Member::class);
    } 

    public function induk(){
        return $this->belongsTo(Induk::class, 'induk_id', 'id');
    }

    public function unit(){
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function dpd(){
        return $this->belongsTo(Dpd::class, 'dpd_id', 'id');
    }

    public function dpc(){
        return $this->belongsTo(Dpc::class, 'dpc_id', 'id');
    }
}
