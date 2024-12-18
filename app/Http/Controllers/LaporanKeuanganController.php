<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanKeuangan;

class LaporanKeuanganController extends Controller
{
    /**
     * Display daily report
     */
    public function dailyReport(Request $request)
    {
        $date = $request->input('date', now()->toDateString());
        $report = LaporanKeuangan::getDailyReport($date);

        return view('laporan.daily', [
            'date' => $date,
            'pemasukan' => $report['pemasukan'],
            'pengeluaran' => $report['pengeluaran'],
        ]);
    }

    /**
     * Display monthly or yearly report
     */
    public function monthlyOrYearlyReport(Request $request)
    {
        $year = $request->input('year', now()->year);
        $month = $request->input('month', null);
        $report = LaporanKeuangan::getMonthlyOrYearlyReport($year, $month);

        return view('laporan.monthly_or_yearly', [
            'year' => $year,
            'month' => $month,
            'pemasukan' => $report['pemasukan'],
            'pengeluaran' => $report['pengeluaran'],
        ]);
    }

    /**
     * Display balance sheet
     */
    public function balanceSheet(Request $request)
    {
        $year = $request->input('year', now()->year);
        $report = LaporanKeuangan::getBalanceSheet($year);

        return view('laporan.balance_sheet', [
            'year' => $year,
            'total_pemasukan' => $report['total_pemasukan'],
            'total_pengeluaran' => $report['total_pengeluaran'],
            'saldo_akhir' => $report['saldo_akhir'],
        ]);
    }
}
