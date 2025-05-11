<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumumans';

    protected $fillable = [
    'judul',
    'teks',
    'tautan',
    'tanggal'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'tautan' => 'string',
    ];
}
