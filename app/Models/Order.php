<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama_barang',
        'no_order',
        'nomor_va',
        'qty',
        'harga',
        'platform',
        'archive_id'
    ];

    public function archive()
    {
        return $this->belongsTo(Archive::class);
    }
}
