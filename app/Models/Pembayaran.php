<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'badan_usaha_id',
        'user_id',
        'metode',
        'bukti_pembayaran',
        'status',
    ];
    public function badanUsaha()
    {
        return $this->belongsTo(BadanUsaha::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
