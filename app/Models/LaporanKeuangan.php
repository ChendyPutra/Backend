<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LaporanKeuangan extends Model
{
    // Tidak perlu menentukan tabel karena laporan keuangan bersifat agregasi.

    /**
     * Get daily financial report
     */
    public static function getDailyReport($date)
    {
        return [
            'pemasukan' => DB::table('pemasukan')
                ->select('kategori_pemasukan as kategori', 'tanggal_pemasukan as tanggal', 'jumlah_pemasukan as jumlah', 'keterangan_pemasukan as keterangan')
                ->whereDate('tanggal_pemasukan', $date)
                ->get(),
            'pengeluaran' => DB::table('pengeluaran')
                ->select('kategori_pengeluaran as kategori', 'tanggal_pengeluaran as tanggal', 'jumlah_pengeluaran as jumlah', 'keterangan_pengeluaran as keterangan')
                ->whereDate('tanggal_pengeluaran', $date)
                ->get(),
        ];
    }

    /**
     * Get monthly or yearly financial report
     */
    public static function getMonthlyOrYearlyReport($year, $month = null)
    {
        $queryPemasukan = DB::table('pemasukan')
            ->selectRaw('MONTH(tanggal_pemasukan) as bulan, SUM(jumlah_pemasukan) as total')
            ->whereYear('tanggal_pemasukan', $year)
            ->groupBy('bulan');

        $queryPengeluaran = DB::table('pengeluaran')
            ->selectRaw('MONTH(tanggal_pengeluaran) as bulan, SUM(jumlah_pengeluaran) as total')
            ->whereYear('tanggal_pengeluaran', $year)
            ->groupBy('bulan');

        if ($month) {
            $queryPemasukan->whereMonth('tanggal_pemasukan', $month);
            $queryPengeluaran->whereMonth('tanggal_pengeluaran', $month);
        }

        return [
            'pemasukan' => $queryPemasukan->get(),
            'pengeluaran' => $queryPengeluaran->get(),
        ];
    }

    /**
     * Get financial balance sheet
     */
    public static function getBalanceSheet($year)
    {
        $pemasukan = DB::table('pemasukan')
            ->whereYear('tanggal_pemasukan', $year)
            ->sum('jumlah_pemasukan');

        $pengeluaran = DB::table('pengeluaran')
            ->whereYear('tanggal_pengeluaran', $year)
            ->sum('jumlah_pengeluaran');

        return [
            'total_pemasukan' => $pemasukan,
            'total_pengeluaran' => $pengeluaran,
            'saldo_akhir' => $pemasukan - $pengeluaran,
        ];
    }
}
