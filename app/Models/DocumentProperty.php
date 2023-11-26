<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class DocumentProperty extends Model
{
    use HasFactory, HasRoles, SoftDeletes, Blameable, HasUuids;

    protected $fillable = [
        'sifat_dokumen',
        'keterangan',
    ];

    public function dokumen()
    {
        return $this->belongsTo(Document::class);
    }
}
