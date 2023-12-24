<?php

namespace App\Http\Controllers\Admin;
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

class LatihController extends Controller
{
	public function index(Request $request)
    {
        $latih = DB::table('datalatih');
        $latih->groupBy('nomor');
        $latih->orderBy('nomor', 'ASC');
        $dt_base= $latih->get();
        $data['latih'] = $dt_base;
        $data['kriteria'] = DB::table('kriteria')->get();
    	return view('admin.latih.list', $data)->with('title','List Data Latih');
    }

    public function tambah()
    {
        $data['kriteria'] = DB::table('kriteria')->get();
        return view('admin.latih.tambah', $data)->with('title','Tambah Data Latih');
    }

    public function simpan(Request $request){
        $valid['nomor'] = 'required';
        $validator = Validator::make($request->all(), $valid);
        if ($validator->fails()) {
            return redirect()->route('admin.latih.tambah')->withErrors($validator)->withInput();
        } else {

            $kriteria = DB::table('kriteria')->get();

            foreach($kriteria as $item){
                $obj = [
                    'nomor' => $request->nomor,
                    'id_kriteria' => $item->id_kriteria,
                    'id_nilai' => $request->post($item->id_kriteria)
                ];
                DB::table('datalatih')->insert($obj);
            }

            return redirect()->route('admin.latih')->with('status', 'Berhasil Menambah Data Latih');
        }
    }

    public function edit($id){
        $data['kriteria'] = DB::table('kriteria')->get();
        $data['latih'] = DB::table('datalatih')->where('id_datalatih', $id)->first();

        return view('admin.latih.edit', $data)->with('title','Edit Data Latih');
    }

    public function update(Request $request){
        $valid['nomor'] = 'required';
        $validator = Validator::make($request->all(), $valid);

        if ($validator->fails()) {
            return redirect()->route('admin.kriteria.edit', $request->id)->withErrors($validator)->withInput();
        } else {
            $kriteria = DB::table('kriteria')->get();

            foreach($kriteria as $item){
                $obj = [
                    'nomor' => $request->nomor,
                    'id_kriteria' => $item->id_kriteria,
                    'id_nilai' => $request->post($item->id_kriteria)
                ];
                DB::table('datalatih')->where('nomor', $request->nomor)->where('id_kriteria', $item->id_kriteria)->update($obj);
            }

            return redirect()->route('admin.latih')->with('status', 'Berhasil Mengubah Data Latih');
        }
    }

    public function hapus($nomor){
        DB::table('datalatih')->where('nomor', $nomor)->delete();

        return redirect()->route('admin.latih')->with('status', 'Berhasil Menghapus Data Latih');
    }
}
