<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BadanUsaha extends Model
{
    protected $fillable = [
        'user_id',
        'nama_pj',
        'bentuk_badan_usaha',
        'jenis_badan_usaha',
        'npwp_bu',
        'email_bu',
        'telepon_bu',
        'kode_pos_bu',
        'alamat_bu',
        'provinsi',
        'kab_kota',
        'pjbu',
        'kualifikasi',
        'photo_pjbu',
        'npwp_bu_file',
        'nib_file',
        'ktp_pjbu_file',
        'npwp_pjbu_file',
        'status_verifikasi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
