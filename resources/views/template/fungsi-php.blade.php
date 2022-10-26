<?php

function formatRupiah($angka)
{
    $hasil_rupiah = 'Rp ' . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
function format_angka($angka)
{
    $hasil_rupiah = number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
function tanggal($tanggal)
{
    return date('d/m/Y', strtotime($tanggal));
}

function singkat_angka($n, $presisi = 1)
{
    if ($n < 900) {
        $format_angka = number_format($n, $presisi);
        $simbol = '';
    } elseif ($n < 900000) {
        $format_angka = number_format($n / 1000, $presisi);
        $simbol = 'K';
    } elseif ($n < 900000000) {
        $format_angka = number_format($n / 1000000, $presisi);
        $simbol = 'jt';
    } elseif ($n < 900000000000) {
        $format_angka = number_format($n / 1000000000, $presisi);
        $simbol = 'M';
    } else {
        $format_angka = number_format($n / 1000000000000, $presisi);
        $simbol = 'T';
    }

    if ($presisi > 0) {
        $pisah = '.' . str_repeat('0', $presisi);
        $format_angka = str_replace($pisah, '', $format_angka);
    }

    return $format_angka . $simbol;
}
?>
