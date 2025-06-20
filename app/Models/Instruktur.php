<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Instruktur extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'email','spesialisasi'];

    public function kursuses()
    {
        return $this->hasMany(Kursus::class);
    }
}
