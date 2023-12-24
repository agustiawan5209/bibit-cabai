<?php

namespace App\Http\Controllers\Petani;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Redirect;
use DateTime;
use DateTimeZone;
use DateInterval;
use DatePeriod;
use UserHelp;
use File;

class LahanController extends Controller
{
    public function index(Request $request)
    {
        $data['kriteria'] = DB::table('kriteria')->where('status_kriteria', 'Diketahui')->get();
        return view('petani.lahan.list', $data)->with('title', 'Data Lahan');
    }

    public function history(Request $request)
    {
        $data['history'] = DB::table('history')->where('id_user', Session::get('id_user'))->get();
        return view('petani.lahan.history', $data)->with('title', 'Data History Lahan');
    }

    public function uji(Request $request)
    {
        $valid['nama_lahan'] = 'required';
        $valid['alamat'] = 'required';
        $validator = Validator::make($request->all(), $valid);

        if ($validator->fails()) {
            return redirect()->route('petani.lahan')->withErrors($validator)->withInput();
        } else {
            $datalatih_nomor = DB::table('datalatih')->groupBy('nomor')->get();

            $datalatih = array();
            foreach ($datalatih_nomor as $item) {

                $datalatih_item = DB::table('datalatih')->select('datalatih.*', 'kriteria.status_kriteria', 'kriteria.nama_kriteria')->join('kriteria', 'kriteria.id_kriteria', 'datalatih.id_kriteria')->where('datalatih.nomor', $item->nomor)->get();

                $datanya['nomor'] = $item->nomor;

                foreach ($datalatih_item as $key) {

                    if ($key->status_kriteria == 'Diketahui') {
                        $get_min_max = $this->get_min_max($key->id_kriteria);
                        $min = $get_min_max['min'];
                        $max = $get_min_max['max'];
                        $len =  ($max -  $min) == 0 ? 1 : ($max - $min);
                        $id_nilai = $key->id_nilai;
                        $nilai_id =  ($id_nilai - $min) == 0 ? 1 : ($id_nilai - $min);

                        $id_nilai = (($nilai_id) / ($len)) * 1 + 0;
                        $id_nilai = round($id_nilai, 4);
                        $datanya[$key->id_kriteria] =  $id_nilai;
                    } else {
                        $nilai = DB::table('nilai')->where('id_nilai', $key->id_nilai)->first();
                        $datanya['hasil'] = $nilai->nama_nilai;
                    }
                }
                array_push($datalatih, $datanya);
            }

            $k = DB::table('datalatih')->groupBy('nomor')->count();
            $nama_lahan = $request->post('nama_lahan');
            $alamat = $request->post('alamat');

            $lahan_norma = [];

            $kriteria = DB::table('kriteria')->where('status_kriteria', 'Diketahui')->get();

            $lahan_norma['nama_lahan'] = $nama_lahan;

            $lahan_norma['alamat'] = $alamat;

            foreach ($kriteria as $item) {
                $get_min_max = $this->get_min_max($item->id_kriteria);
                $min = $get_min_max['min'];
                $max = $get_min_max['max'];
                $len =  ($max -  $min) == 0 ? 1 : ($max - $min);

                $id_nilai = $request->post($item->id_kriteria);
                $nilai_id =  ($id_nilai - $min) == 0 ? 1 : ($id_nilai - $min);

                $id_nilai = (($nilai_id) / ($len)) * 1 + 0;
                $id_nilai = round($id_nilai, 4);

                $obj = [
                    'nama_lahan' => $nama_lahan,
                    'alamat' => $alamat,
                    'id_kriteria' => $item->id_kriteria,
                    'nilai' => $id_nilai,
                ];

                $lahan_norma[$item->id_kriteria] = $id_nilai;
            }

            $DISTANCES = array();
            // dd($datalatih);
            for ($j = 0; $j < count($datalatih); $j++) {
                $dist['distance'] = $this->distance($lahan_norma, $datalatih[$j]);
                $kriteria = DB::table('kriteria')->where('status_kriteria', 'Diketahui')->get();
                $dist['nomor'] = $datalatih[$j]['nomor'];
                foreach ($kriteria as $key) {
                    $dist[$key->id_kriteria] = $datalatih[$j][$key->id_kriteria];
                }

                $dist['hasil'] = $datalatih[$j]['hasil'];

                array_push($DISTANCES, $dist);
            }

            sort($DISTANCES); //mengurutkan distance dari terdekat

            $K_VALUE = $k;
            $NEIGHBOUR = array();
            // dd($K_VALUE,$DISTANCES[4]);
            for ($k = 0; $k < $K_VALUE; $k++) //memetakan tetangga
            {
                if (!isset($NEIGHBOUR[$DISTANCES[$k]['hasil']]))
                    $NEIGHBOUR[$DISTANCES[$k]['hasil']] = array();

                array_push($NEIGHBOUR[$DISTANCES[$k]['hasil']], $DISTANCES[$k]);
            }

            $terbesar =  array(); //mencari tetangga terbanyak
            foreach (array_keys($NEIGHBOUR) as $paramName) {
                // echo count($NEIGHBOUR[ $paramName ]).'<br> '.count( $terbesar ).' ';
                if (count($NEIGHBOUR[$paramName])  > count($terbesar)) {
                    $terbesar = $NEIGHBOUR[$paramName];
                }
                // print_r($paramName);
            }
            // exit;

            // echo '<pre>'; print_r($NEIGHBOUR); echo '</pre>'; exit;

            $lahan_norma['hasil'] = $terbesar[0]['hasil'];

            $data["K_VALUE"] = $K_VALUE;
            $data["NEIGHBOURS"] = $NEIGHBOUR;

            $data["distances"] = $DISTANCES;
            //ubah ke array object
            // foreach( $data["distances"]  as  $ind=>$val )
            // {
            //     $data["distances"][ $ind ] = (object) $data["distances"][ $ind ];
            // }
            $data["lahan_norma"] = $lahan_norma;
            $data['request'] = $request->post();

            $data['kriteria'] = DB::table('kriteria')->where('status_kriteria', 'Diketahui')->get();

            $cek = DB::table('history')->where('nama_lahan', $nama_lahan)->where('alamat', $alamat)->first();

            if (!$cek) {
                $obj = [
                    'id_user' => Session::get('id_user'),
                    'nama_lahan' => $nama_lahan,
                    'alamat' => $alamat,
                    'waktu' => date('Y-m-d H:i:s'),
                    'hasil' => $lahan_norma["hasil"]
                ];
                DB::table('history')->insert($obj);
            }
            $data_layak = [];
            $data_Tidak_layak = [];
            for ($i = 0; $i < count($DISTANCES); $i++) {
                for ($k = 0; $k < count($DISTANCES[$i]); $k++) {
                    if ($DISTANCES[$i]['hasil'] !== 'Tidak layak') {
                        $data_layak[$i] = $DISTANCES[$i]['hasil'];
                    } else {
                        $data_Tidak_layak[$i] = $DISTANCES[$i]['hasil'];
                    }
                }
            }
            // dd($data);
            return view('petani.lahan.uji', $data)->with('title', 'Hasil Uji Lahan');
        }
    }

    // public function validationErrorDataKNN($data_uji)
    // {

    //     // Tampilan Error untuk Setiap Kriteria
    //     $validasi = [
    //         'K001' => [
    //             'suhu terlalu dingin',
    //             'suhu terlalu panas',
    //         ],
    //         'K002' => [
    //             'PH tanah dinaikkan',
    //             'ph tanah diturunkan',
    //         ],
    //         'K003' => [
    //             'kelembapan dinaikkan',
    //             'kelembapan tanah diturunkan',
    //         ],
    //         'K004' => [
    //             'ketinggian dinaikkan',
    //             'ketinggian diturunkan',
    //         ],
    //         'K005' => [
    //             'tekstur tanah dirubah',
    //             'tekstur tanah dirubah',
    //         ],
    //     ];
    //     $kriteria = [];
    //     $data_kriteria = DB::table('kriteria')->where('status_kriteria', 'Diketahui')->get();
    //     $nomor = 1;

    //     // Buat Sebuah Array Untuk Kode Kriteria
    //     foreach ($data_kriteria as $key => $value) {
    //         $kriteria[] = "K00" . $nomor++;
    //     }

    //     $batas_kriteria = [
    //         'K001' => ['minimal' => 0, 'maksimal' => 1],
    //         'K002' => ['minimal' => 0, 'maksimal' => 1],
    //         'K003' => ['minimal' => 0, 'maksimal' => 1],
    //         'K004' => ['minimal' => 0, 'maksimal' => 1],
    //         'K005' => ['minimal' => 0, 'maksimal' => 1],
    //     ];

    //     $reqInput = [];

    //     // Variabel Menampilkan Hasil
    //     $result = [];

    //     // Memasukkan Niai dari Hasil K-NN Kedalam variabel request Input Untuk Pengecekan Nilai
    //     foreach ($data_uji as $key => $value) {
    //         // Cek Jika Dalam Array Terdapat Nilai Yang Sama
    //         if (in_array($key, $kriteria)) {
    //             $reqInput[$key] = $value;
    //         }
    //     }
    //     foreach ($data_uji as $key => $value) {

    //         if ($key == "hasil") {
    //             // Cek Jika Value Terdapat Kata Tidak layak
    //             if ($value == "Tidak layak" || $value == 'Tidak Layak') {
    //                 // Perulangan Untuk Menentukan Kondisi
    //                 for ($i = 0; $i < count($kriteria); $i++) {
    //                     $nilai_input = $reqInput[$kriteria[$i]];
    //                     // variabel minimal
    //                     if (isset($batas_kriteria[$kriteria[$i]]['minimal'])) {
    //                         $minimal = $batas_kriteria[$kriteria[$i]]['minimal'];
    //                     }
    //                     // variabel maksimal
    //                     if (isset($batas_kriteria[$kriteria[$i]]['maksimal'])) {
    //                         $maksimal = $batas_kriteria[$kriteria[$i]]['maksimal'];
    //                     }

    //                     // Cek Jika Dalam Minimal dan maksimal Data Adalah Angka
    //                     if (isset($minimal) || isset($maksimal)) {
    //                         if (is_numeric($minimal) && !is_string($minimal) || is_numeric($maksimal) && !is_string($maksimal)) {
    //                             // Cek Jika Dalam input Data Lebih Kecil Dari Minimal Data

    //                             // Jika Minimal Data Lebih Kecil Dari Input
    //                             if ($nilai_input <= intval($minimal)) {
    //                                 $result[] = $validasi[$kriteria[$i]][0];

    //                                 // Jika maksimal Data Lebih Besar Dari Input
    //                             } elseif ($nilai_input > round($maksimal, 2)) {
    //                                 if (isset($validasi[$kriteria[$i]][1])) {
    //                                     $result[] = $validasi[$kriteria[$i]][1];
    //                                 } else {
    //                                     $result[] = $validasi[$kriteria[$i]][0];
    //                                 }
    //                             }
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //     }
    //     // cek Hasil
    //     // dd($result, $reqInput, $data_uji);
    //     return $result;
    // }

    public function distance($data_uji, $data_testing)
    {
        $kriteria = DB::table('kriteria')->where('status_kriteria', 'Diketahui')->get();
        $value = 0;

        foreach ($kriteria as $key) {
            $value += pow(($data_uji[$key->id_kriteria] - $data_testing[$key->id_kriteria]), 2);
        }
        return round(sqrt($value), 6);
    }

    public function get_min_max($id_kriteria)
    {
        $min = DB::table('datalatih')->where('id_kriteria', $id_kriteria)->orderBy('id_nilai', 'ASC')->first()->id_nilai;
        $max = DB::table('datalatih')->where('id_kriteria', $id_kriteria)->orderBy('id_nilai', 'DESC')->first()->id_nilai;

        return array('min' => $min, 'max' => $max);
    }
}
