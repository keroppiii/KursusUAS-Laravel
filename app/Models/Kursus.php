<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kursus extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kursus', 'durasi', 'instruktur_id', 'biaya'];
    protected $table = 'kursuses';

    public function instruktur()
    {
        return $this->belongsTo(Instruktur::class);
    }

    public function materis()
    {
        return $this->hasMany(Materi::class);
    }

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}
