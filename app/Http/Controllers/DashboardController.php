<?php

namespace App\Http\Controllers;

use App\Models\PelakuUsaha;
use App\Models\RekapitulasiBiaya;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Ambil month & year dari request, default ke bulan sekarang
        $month = request()->input('month', now()->month);
        $year = request()->input('year', now()->year);
        
        // Convert ke integer untuk safety
        $month = (int) $month;
        $year = (int) $year;
        
        // Pastikan month valid (1-12)
        if ($month < 1 || $month > 12) {
            $month = now()->month;
        }

        // Data untuk semua user: Pelaku Usaha per bulan
        $pelakuUsahaThisMonth = PelakuUsaha::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();

        $pelakuUsahaBySkala = PelakuUsaha::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->selectRaw('skala_usaha, COUNT(*) as total')
            ->groupBy('skala_usaha')
            ->get();

        // Data untuk 12 bulan terakhir (Pelaku Usaha) - dari periode yang dipilih
        $selectedDate = Carbon::create($year, $month, 1);
        $pelakuUsaha12Months = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = $selectedDate->copy()->subMonths($i);
            $count = PelakuUsaha::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            $pelakuUsaha12Months[
                $date->format('M')
            ] = $count;
        }

        // Rekapitulasi bulan ini (semua status) untuk menghitung total kontrak yang masuk
        $allRekapThisMonth = RekapitulasiBiaya::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        // Rekapitulasi Final bulan ini (untuk menghitung yang sudah selesai)
        $rekapFinalThisMonth = RekapitulasiBiaya::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->where('status', 'Final')
            ->get();
        
        // Rekapitulasi Draft bulan ini
        $rekapDraftThisMonth = RekapitulasiBiaya::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->where('status', 'Draft')
            ->get();
        
        // Pelaku Usaha terdaftar di bulan ini (untuk menghitung rekap yang belum selesai)
        $pelakuUsahaRegisteredThisMonth = PelakuUsaha::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();
        
        // Pelaku usaha yang sudah punya rekapitulasi (baik draft maupun final)
        $rekapTouched = RekapitulasiBiaya::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->distinct('pelaku_usaha_id')
            ->count('pelaku_usaha_id');
        
        // Rekap yang belum disentuh = pelaku usaha yang belum ada rekap sama sekali
        $rekapNotTouchedThisMonth = $pelakuUsahaRegisteredThisMonth - $rekapTouched;
        
        // Data default untuk semua user
        $totalBiaya = 0;
        $totalBpjph = 0;
        $totalLph = 0;
        $totalUin = 0;
        $totalOps = 0;
        $totalMargin = 0;
        $keuangan12Months = [];
        $isAdmin = false;

        // Jika admin: tambahkan data keuangan
        if (strtolower((string)$user->level) === 'admin' || (int)$user->level === 1) {
            $isAdmin = true;
            // Total Kontrak dari SEMUA rekapitulasi yang masuk (Draft atau Final)
            $totalBiaya = $allRekapThisMonth->sum('total_kontrak');
            // Potongan & Biaya dari rekapitulasi yang sudah Final
            $totalBpjph = $rekapFinalThisMonth->sum('potongan_bpjph');
            $totalLph = $rekapFinalThisMonth->sum('biaya_admin_lph');
            $totalUin = $rekapFinalThisMonth->sum('potongan_uin');
            $totalOps = $rekapFinalThisMonth->sum('total_biaya_ops');
            $totalMargin = $rekapFinalThisMonth->sum('sisa_margin');

            // Data keuangan 12 bulan terakhir (dari periode yang dipilih)
            $selectedDateKeuangan = Carbon::create($year, $month, 1);
            
            for ($i = 11; $i >= 0; $i--) {
                $date = $selectedDateKeuangan->copy()->subMonths($i);
                $total = RekapitulasiBiaya::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->sum('total_kontrak');
                $keuangan12Months[$date->format('M')] = (int) $total;
            }
        }

        return view('dashboard', compact(
            'user',
            'isAdmin',
            'month',
            'year',
            'rekapFinalThisMonth',
            'rekapDraftThisMonth',
            'rekapNotTouchedThisMonth',
            'pelakuUsahaThisMonth',
            'pelakuUsahaBySkala',
            'pelakuUsaha12Months',
            'totalBiaya',
            'totalBpjph',
            'totalLph',
            'totalUin',
            'totalOps',
            'totalMargin',
            'keuangan12Months'
        ));
    }
}
