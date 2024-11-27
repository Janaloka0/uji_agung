<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Tugas3_15225001_Marwan_Controller extends Controller
{
    const DATAKENDARAAN = [
        ['no_plat' => 'KB 1234 WA', 'pemilik' => 'John Doe', 'jenis' => 'SUV'],
        ['no_plat' => 'KB 5678 HU', 'pemilik' => 'Jane Smith', 'jenis' => 'MVV'],
        ['no_plat' => 'KB 2345 AB', 'pemilik' => 'Alice Brown', 'jenis' => 'SUV'],
        ['no_plat' => 'KB 6789 CD', 'pemilik' => 'Bob Johnson', 'jenis' => 'MVV'],
        ['no_plat' => 'KB 9012 EF', 'pemilik' => 'Charlie Davis', 'jenis' => 'SUV'],
        ['no_plat' => 'KB 7894 GH', 'pemilik' => 'Diana King', 'jenis' => 'SUV'],
        ['no_plat' => 'KB 2468 KL', 'pemilik' => 'Fiona Clark', 'jenis' => 'MVV'],
        ['no_plat' => 'KB 1357 MN', 'pemilik' => 'George Harris', 'jenis' => 'SUV'],
        ['no_plat' => 'KB 8642 OP', 'pemilik' => 'Hannah Lewis', 'jenis' => 'MVV'],
        ['no_plat' => 'KB 3468 ST', 'pemilik' => 'Ian Martin', 'jenis' => 'SUV'],
        ['no_plat' => 'KB 2457 QR', 'pemilik' => 'Julia Hall', 'jenis' => 'MVV'],
        ['no_plat' => 'KB 1235 TU', 'pemilik' => 'Mike Scott', 'jenis' => 'SUV'],
        ['no_plat' => 'KB 9876 WX', 'pemilik' => 'Noah Adams', 'jenis' => 'MVV'],
        ['no_plat' => 'KB 5432 YZ', 'pemilik' => 'Olivia Baker', 'jenis' => 'SUV'],
        ['no_plat' => 'KB 1098 UV', 'pemilik' => 'Paul Turner', 'jenis' => 'MVV'],
        ['no_plat' => 'KB 2048 EE', 'pemilik' => 'Riley Carter', 'jenis' => 'SUV'],
        ['no_plat' => 'KB 3579 AB', 'pemilik' => 'Sophia Mitchell', 'jenis' => 'MVV'],
        ['no_plat' => 'KB 8643 KL', 'pemilik' => 'Emma Watson', 'jenis' => 'SUV'],
        ['no_plat' => 'KB 7531 MN', 'pemilik' => 'Liam Wilson', 'jenis' => 'MVV'],
        ['no_plat' => 'KB 2469 OP', 'pemilik' => 'Charlotte Brown', 'jenis' => 'SUV'],
        ['no_plat' => 'KB 1358 FF', 'pemilik' => 'James Davis', 'jenis' => 'MVV'],
      ];

    public function index()
    {
    $dataKendaraan = collect(self::DATAKENDARAAN)->map(function ($item) {
            $lastDigit = $this->getLastDigit($item['no_plat']);
            $item['ganjil'] = $lastDigit % 2 !== 0 ? 'Ya' : 'Tidak';
            $item['genap'] = $lastDigit % 2 === 0 ? 'Ya' : 'Tidak';
            return $item;
        })->toArray();

        // Urutkan data berdasarkan nama pemilik
        usort($dataKendaraan, function ($a, $b) {
            return strcmp($a['pemilik'], $b['pemilik']);
        });

        // Hitung resume
        $resume = [
            'ganjil' => 0,
            'genap' => 0,
            'SUV' => 0,
            'MVV' => 0,
        ];

        foreach ($dataKendaraan as $kendaraan) {
            $lastDigit = $this->getLastDigit($kendaraan['no_plat']);

            if ($lastDigit % 2 == 0) {
                $resume['genap']++;
            } else {
                $resume['ganjil']++;
            }

            if ($kendaraan['jenis'] === 'SUV') {
                $resume['SUV']++;
            } elseif ($kendaraan['jenis'] === 'MVV') {
                $resume['MVV']++;
            }
        }

        return view('index', [
            'data' => $dataKendaraan, // Data yang sudah diurutkan dan diproses
            'resume' => $resume
        ]);
    }


    public function show($no_plat)
    {
        return view('index', [
            "data" => $this->filter($no_plat),
            "resume" => null // Tidak perlu resume untuk data individual
        ]);
    }

    public function filter($no_plat)
    {
        // Mencari data kendaraan berdasarkan no_plat
        return collect(self::DATAKENDARAAN)->firstWhere('no_plat', $no_plat);
    }

    public function calculateResume()
    {
         // Proses data dan tambahkan informasi ganjil/genap
         $dataKendaraan = collect(self::DATAKENDARAAN)->map(function ($item) {
            $lastDigit = $this->getLastDigit($item['no_plat']);
            $item['ganjil'] = $lastDigit % 2 !== 0 ? 'Ya' : 'Tidak';
            $item['genap'] = $lastDigit % 2 === 0 ? 'Ya' : 'Tidak';
            return $item;
        })->toArray();

        // Urutkan data berdasarkan nama pemilik
        usort($dataKendaraan, function ($a, $b) {
            return strcmp($a['pemilik'], $b['pemilik']);
        });

        // Hitung resume
        $resume = [
            'ganjil' => 0,
            'genap' => 0,
            'SUV' => 0,
            'MVV' => 0,
        ];

        foreach ($dataKendaraan as $kendaraan) {
            $lastDigit = $this->getLastDigit($kendaraan['no_plat']);

            if ($lastDigit % 2 == 0) {
                $resume['genap']++;
            } else {
                $resume['ganjil']++;
            }

            if ($kendaraan['jenis'] === 'SUV') {
                $resume['SUV']++;
            } elseif ($kendaraan['jenis'] === 'MVV') {
                $resume['MVV']++;
            }
        }

        return $resume;
    }

    public function getLastDigit($no_plat)
    {
        // // Mengambil karakter terakhir dan memastikan bahwa itu adalah angka
        // $lastChar = substr($no_plat, -1); // Ambil karakter terakhir

        // // Jika karakter terakhir bukan angka, cari angka sebelumnya
        // while (!is_numeric($lastChar)) {
        //     $no_plat = substr($no_plat, 0, -1); // Hapus karakter terakhir
        //     $lastChar = substr($no_plat, -1); // Ambil karakter terakhir lagi
        // }

        // return (int)$lastChar; // Kembalikan sebagai integer

        preg_match('/\d(?!.*\d)/', $no_plat, $matches);
        return isset($matches[0]) ? intval($matches[0]) : 0;
    }
      
}
