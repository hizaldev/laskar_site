<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class News extends Model
{
    use HasFactory, SoftDeletes, HasUuids, Blameable, HasRoles;

    protected $fillable = [
        'judul',
        'kategori_berita_id',
        'berita',
        'penulis',
        'slug',
        'is_show',
        'is_schedule',
        'is_public',
        'tgl_tayang_mulai',
        'tgl_tayang_berakhir',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'judul'
            ]
        ];
    }

    public function documentation(){
        return $this->hasMany(NewsDocumentation::class, 'news_id', 'id')->orderBy('initial');
    }
}
