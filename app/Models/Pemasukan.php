<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    // Specify the table name if it's not the default plural of the class name
    protected $table = 'pemasukan';

    // Define the primary key column
    protected $primaryKey = 'id'; // Matches the `id` column in the migration

    // Specify the fillable fields
    protected $fillable = [
        'sumber_dana',
        'jumlah_pemasukan',
        'tanggal_pemasukan',
        'keterangan_pemasukan', // Adjusted to match the column name in the migration
        'admin_id' // Adjusted to match the foreign key column name
    ];

    // Define the casts for specific fields
    protected $casts = [
        'tanggal_pemasukan' => 'date',
        'jumlah_pemasukan' => 'decimal:2'
    ];

    // Define the relationship with the Admin model
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id'); // Adjusted to match the foreign key and primary key
    }
}
