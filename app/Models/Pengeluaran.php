<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'pengeluaran';

    // Define the primary key
    protected $primaryKey = 'id'; // Matches the `id` column in the migration

    // Allow mass-assignment for the specified attributes
    protected $fillable = [
        'kategori_pengeluaran',
        'jumlah_pengeluaran',
        'tanggal_pengeluaran',
        'keterangan_pengeluaran',
        'admin_id',
    ];

    // Cast attributes to specific data types
    protected $casts = [
        'tanggal_pengeluaran' => 'date',
        'jumlah_pengeluaran' => 'decimal:2',
    ];

    // Define the relationship with the Admin model
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }
}
