<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingsWebsite extends Model
{
    protected $table = 'settings_website';
    protected $fillable = [
        'nama_website',
        'signature',
        'rekening_nama',
        'rekening_bank',
        'rekening_nomor',
    ];
}
