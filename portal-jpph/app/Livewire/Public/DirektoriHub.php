<?php

namespace App\Livewire\Public;

use Livewire\Component;

class DirektoriHub extends Component
{
    public string $search = '';

    public string $negeri = '';

    public function render()
    {
        $cawangan = collect([
            ['negeri' => 'Putrajaya', 'nama' => 'Ibu Pejabat JPPH', 'alamat' => 'Aras 4-7, Blok A, Kompleks Kementerian Kewangan, Persiaran Perdana, Presint 2, 62592 Putrajaya', 'tel' => '03-8000 8000', 'email' => 'webmaster@jpph.gov.my'],
            ['negeri' => 'Selangor', 'nama' => 'JPPH Negeri Selangor', 'alamat' => 'Tingkat 14, Wisma Sime Darby, Jalan Raja Laut, 50350 Kuala Lumpur', 'tel' => '03-2693 1500', 'email' => 'selangor@jpph.gov.my'],
            ['negeri' => 'Kuala Lumpur', 'nama' => 'JPPH Wilayah Persekutuan KL', 'alamat' => 'Tingkat 5, Bangunan Sulaiman, Jalan Sultan Hishamuddin, 50676 Kuala Lumpur', 'tel' => '03-2273 1099', 'email' => 'kl@jpph.gov.my'],
            ['negeri' => 'Pulau Pinang', 'nama' => 'JPPH Pulau Pinang', 'alamat' => 'Tingkat 24, Komtar, 10000 George Town, Pulau Pinang', 'tel' => '04-2628 411', 'email' => 'penang@jpph.gov.my'],
            ['negeri' => 'Johor', 'nama' => 'JPPH Negeri Johor', 'alamat' => 'Tingkat 7, Wisma Persekutuan, Jalan Air Molek, 80590 Johor Bahru', 'tel' => '07-2244 244', 'email' => 'johor@jpph.gov.my'],
            ['negeri' => 'Perak', 'nama' => 'JPPH Negeri Perak', 'alamat' => 'Tingkat 3, Bangunan Tabung Haji, Jalan Greentown, 30450 Ipoh', 'tel' => '05-2557 800', 'email' => 'perak@jpph.gov.my'],
            ['negeri' => 'Kedah', 'nama' => 'JPPH Negeri Kedah', 'alamat' => 'Tingkat 4, Wisma Persekutuan, Jalan Kolam Air, 05050 Alor Setar', 'tel' => '04-7331 011', 'email' => 'kedah@jpph.gov.my'],
            ['negeri' => 'Kelantan', 'nama' => 'JPPH Negeri Kelantan', 'alamat' => 'Tingkat 5, Wisma Persekutuan, Jalan Bayam, 15050 Kota Bharu', 'tel' => '09-7480 600', 'email' => 'kelantan@jpph.gov.my'],
            ['negeri' => 'Pahang', 'nama' => 'JPPH Negeri Pahang', 'alamat' => 'Tingkat 6, Wisma Persekutuan, Jalan Gambut, 25000 Kuantan', 'tel' => '09-5135 800', 'email' => 'pahang@jpph.gov.my'],
            ['negeri' => 'Terengganu', 'nama' => 'JPPH Negeri Terengganu', 'alamat' => 'Tingkat 9, Wisma Persekutuan, Jalan Sultan Ismail, 20200 Kuala Terengganu', 'tel' => '09-6230 100', 'email' => 'terengganu@jpph.gov.my'],
            ['negeri' => 'Melaka', 'nama' => 'JPPH Negeri Melaka', 'alamat' => 'Tingkat 4, Wisma Persekutuan, Jalan Hang Tuah, 75300 Melaka', 'tel' => '06-2826 700', 'email' => 'melaka@jpph.gov.my'],
            ['negeri' => 'Negeri Sembilan', 'nama' => 'JPPH Negeri Sembilan', 'alamat' => 'Tingkat 6, Wisma Persekutuan, Jalan Dato\' Abdul Kadir, 70200 Seremban', 'tel' => '06-7681 500', 'email' => 'n9@jpph.gov.my'],
            ['negeri' => 'Perlis', 'nama' => 'JPPH Negeri Perlis', 'alamat' => 'Wisma Persekutuan, Jalan Persiaran Jubli Emas, 01000 Kangar', 'tel' => '04-9762 444', 'email' => 'perlis@jpph.gov.my'],
            ['negeri' => 'Sabah', 'nama' => 'JPPH Negeri Sabah', 'alamat' => 'Tingkat 6, Bangunan Persekutuan, Jalan Tuaran, 88300 Kota Kinabalu', 'tel' => '088-516 800', 'email' => 'sabah@jpph.gov.my'],
            ['negeri' => 'Sarawak', 'nama' => 'JPPH Negeri Sarawak', 'alamat' => 'Tingkat 7, Bangunan Persekutuan, Jalan Tun Abang Haji Openg, 93590 Kuching', 'tel' => '082-2455 444', 'email' => 'sarawak@jpph.gov.my'],
        ]);

        if ($this->negeri) {
            $cawangan = $cawangan->where('negeri', $this->negeri);
        }
        if ($this->search) {
            $needle = strtolower($this->search);
            $cawangan = $cawangan->filter(fn ($c) =>
                str_contains(strtolower($c['nama']), $needle)
                || str_contains(strtolower($c['alamat']), $needle)
                || str_contains(strtolower($c['negeri']), $needle)
            );
        }

        $negeriList = ['', 'Putrajaya', 'Kuala Lumpur', 'Selangor', 'Pulau Pinang', 'Johor', 'Perak', 'Kedah', 'Kelantan', 'Pahang', 'Terengganu', 'Melaka', 'Negeri Sembilan', 'Perlis', 'Sabah', 'Sarawak'];

        return view('livewire.public.direktori-hub', [
            'cawangan' => $cawangan->values(),
            'negeriList' => $negeriList,
        ]);
    }
}
