<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapDocument extends Model
{
    use HasFactory, Blameable, HasUuids;

    protected $fillable = [
        'document_id',
        'jenis_document_id',
    ];

    public function dokumen()
    {
        return $this->belongsToMany(MapDocument::class);
    }

    public function kategori()
    {
        return $this->hasOne(JenisDocument::class, 'id', 'jenis_document_id');
    }
}
