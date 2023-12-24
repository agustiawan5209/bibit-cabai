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

class NilaiController extends Controller
{
	public function index(Request $request)
    { 
        $nilai = DB::table('nilai')->select('nilai.*', 'kriteria.nama_kriteria');
        $nilai->join('kriteria', 'nilai.id_kriteria', 'kriteria.id_kriteria');
        $dt_base= $nilai->get();
        $data['nilai'] = $dt_base;
    	return view('admin.nilai.list', $data)->with('title','List Nilai Kriteria'); 
    }

    public function tambah()
    { 
        $data['kriteria'] = DB::table('kriteria')->where('nilai', '1')->get();
        return view('admin.nilai.tambah', $data)->with('title','Tambah Nilai Kriteria'); 
    }

    public function simpan(Request $request){
        $valid['id_kriteria'] = 'required';
        $valid['nama_nilai'] = 'required';
        $validator = Validator::make($request->all(), $valid);

        if ($validator->fails()) {
            return redirect()->route('admin.nilai.tambah')->withErrors($validator)->withInput();
        } else {
            $obj = [
                'id_kriteria' => $request->id_kriteria,
                'nama_nilai' => $request->nama_nilai,
            ];
            DB::table('nilai')->insert($obj);

            return redirect()->route('admin.nilai')->with('status', 'Berhasil Menambah Data Nilai Kriteria');
        }
    }

    public function edit($id){
        $data['kriteria'] = DB::table('kriteria')->where('nilai', '1')->get();
        $data['nilai'] = DB::table('nilai')->where('id_nilai', $id)->first();

        return view('admin.nilai.edit', $data)->with('title','Edit Nilai Kriteria'); 
    }

    public function update(Request $request){
        $valid['id_kriteria'] = 'required';
        $valid['nama_nilai'] = 'required';
        $validator = Validator::make($request->all(), $valid);

        if ($validator->fails()) {
            return redirect()->route('admin.nilai.edit', $request->id)->withErrors($validator)->withInput();
        } else {
            $obj = [
                'id_kriteria' => $request->id_kriteria,
                'nama_nilai' => $request->nama_nilai,
            ];
            DB::table('nilai')->where('id_nilai', $request->id)->update($obj);

            return redirect()->route('admin.nilai')->with('status', 'Berhasil Mengubah Data Nilai Kriteria');
        }
    }

    public function hapus($id){
        DB::table('nilai')->where('id_nilai', $id)->delete();

        return redirect()->route('admin.nilai')->with('status', 'Berhasil Menghapus Data Nilai Kriteria');
    }
}