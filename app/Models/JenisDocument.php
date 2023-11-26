<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class JenisDocument extends Model
{
    use HasFactory, HasRoles, SoftDeletes, Blameable, HasUuids;

    protected $fillable = [
        'jenis_dokumen',
        'keterangan',
    ];

    public function maping()
    {
        return $this->hasOne(MapDocument::class);
    }
}
