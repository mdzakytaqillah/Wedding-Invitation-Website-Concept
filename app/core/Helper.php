<?php
class Helper {
    public static function tanggalText($tanggal) {
        if (empty($tanggal)) return "-";

        $hari = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];

        $bulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];

        $timestamp = strtotime($tanggal);
        $nama_hari = $hari[date('l', $timestamp)];
        $tgl = date('d', $timestamp);
        $bln = $bulan[date('m', $timestamp)];
        $thn = date('Y', $timestamp);

        return "$nama_hari, $tgl $bln $thn";
    }

    public static function waktuText($start, $end, $timezone = 'WIB') {
        if (empty($start) || !isset($start)) return NULL;
        if (empty($timezone) || !isset($timezone)) $timezone = 'WIB';
        $mulai = date('H:i', strtotime($start));
        if (isset($end) && !empty($end) && $end != '00:00:00') {
            $selesai = date('H:i', strtotime($end));
            return "Pukul $mulai - $selesai $timezone";
        } else {
            return "Pukul $mulai $timezone - Selesai";
        }
    }

    public static function ISO8601Timestamp($date, $time, $timezone = 'WIB') {
        $offsets = [
        'WIB'  => '+07:00',
        'WITA' => '+08:00',
        'WIT'  => '+09:00'
        ];
        $timeOffset = isset($offsets[$timezone]) ? $offsets[$timezone] : '+07:00';
        return $date . 'T' . $time . $timeOffset;
    }

    public static function urlvalidate($type, $url) {
        if (empty($url)) return NULL;

        if ($type === 'YouTube') {
            $pattern = '/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+$/';
        }

        if ($type === 'Google Maps') {
            $pattern = '/^(https?:\/\/)?(www\.)?(google\.[a-z.]+\/maps\/|maps\.google\.[a-z.]+\/|goo\.gl\/maps\/|maps\.app\.goo\.gl\/|googleusercontent\.com\/maps\.google\.com\/[01]).*$/i';
        }

        if (preg_match($pattern, $url)) {
            return true;
        } else {
            return false;
        }
    }

    public static function getYouTubeID($url) {
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';

        if (preg_match($pattern, $url, $match)) {
            return $match[1]; 
        }
        return null;
    }

    public static function urlnormalize($url) {
        if (!empty($url)) {
            if (strpos($url, 'http://') !== 0 && strpos($url, 'https://') !== 0) {
                $url = 'https://' . $url;
            }
        }
        return $url;
    }

    public static function userconserned($type, $objectName) {
        $requiredPhrase = "HAPUS " . strtoupper($type) . " " . strtoupper($objectName) . " SEKARANG";
        return $requiredPhrase;
    }
}