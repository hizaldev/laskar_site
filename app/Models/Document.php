<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Document extends Model
{
    use HasFactory, HasRoles, SoftDeletes, Blameable, HasUuids;

    protected $fillable = [
        'perihal',
        'document_properties_id',
        'slug',
        'is_public',
        'jenis_document_id',
        'user_id',
        'tgl_document',
        'no_document',
        'location',
        'keterangan',
        'document',
        'links',
    ];


    public function map_kategori()
    {
        return $this->hasMany(MapDocument::class, 'document_id', 'id');
    }

    public function properties()
    {
        return $this->hasOne(DocumentProperty::class, 'id', 'document_properties_id');
    }
}
