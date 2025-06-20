<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peserta extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'email'];

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}
