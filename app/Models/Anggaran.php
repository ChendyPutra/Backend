<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggaran extends Model
{
    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'anggaran';

    // Define the primary key column
    protected $primaryKey = 'id'; // Matches the `id` column in the migration

    // Allow mass-assignment for the specified attributes
    protected $fillable = [
        'tanggal_anggaran',
        'keterangan_anggaran',
        'jumlah_anggaran',
        'rencana_anggaran',
    ];

    // Cast attributes to specific data types
    protected $casts = [
        'tanggal_anggaran' => 'date',
        'jumlah_anggaran' => 'decimal:2',
    ];

    // Add relationships here if needed in the future
}
