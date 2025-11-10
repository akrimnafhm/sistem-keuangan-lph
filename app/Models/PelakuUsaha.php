<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravolt\Indonesia\Models\City;

/**
 * @property int $id
 * @property string $no_sttd
 * @property string $nama_usaha
 * @property string $alamat_lengkap
 * @property string $city_id
 * @property string $skala_usaha
 * @property string $jenis_produk
 * @property int $jumlah_produk
 * @property float $biaya
 * @property int $jumlah_audit
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Laravolt\Indonesia\Models\City $city
 */

class PelakuUsaha extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_sttd',
        'nama_usaha',
        'alamat_lengkap',
        'wilayah_id',
        'city_id',
        'skala_usaha',
        'jenis_produk',
        'jumlah_produk',
        'biaya',
        'jumlah_audit',
    ];

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }

    /**
     * Relationship to Laravolt City model.
     * The pelaku_usahas.city_id stores the city code (char), so we join on the 'code' column.
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'code');
    }
}

