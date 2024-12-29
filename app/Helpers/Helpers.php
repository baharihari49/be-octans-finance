<?php

namespace App\Helpers;
use Illuminate\Support\Carbon;

class Helpers
{
    public static function getYear()
    {
        // Mengatur zona waktu menjadi "Asia/Jakarta"
        $tanggalSaatIni = Carbon::now();

        // Mengatur zona waktu "Asia/Jakarta"
        $tanggalSaatIni->setTimezone('Asia/Jakarta');

        // Format tanggal sesuai dengan kebutuhan Anda
        $tanggalSaatIniFormatted = $tanggalSaatIni->format('Y-m-d H:i:s');

        // Mendapatkan bulan saat ini dalam bentuk nomor (1-12)
        return $tanggalSaatIni->year;
    }

    public static function getMonth()
    {
        // Mengatur zona waktu menjadi "Asia/Jakarta"
        $tanggalSaatIni = Carbon::now();

        // Mengatur zona waktu "Asia/Jakarta"
        $tanggalSaatIni->setTimezone('Asia/Jakarta');

        // Format tanggal sesuai dengan kebutuhan Anda
        $tanggalSaatIniFormatted = $tanggalSaatIni->format('Y-m-d H:i:s');

        // Mendapatkan bulan saat ini dalam bentuk nomor (1-12)
        return $tanggalSaatIni->month;
    }
}
