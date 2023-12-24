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

class KriteriaController extends Controller
{
	public function index(Request $request)
    { 
        $kriteria = DB::table('kriteria');
        $dt_base= $kriteria->get();
        $data['kriteria'] = $dt_base;
    	return view('admin.kriteria.list', $data)->with('title','List Kriteria'); 
    }

    public function tambah()
    { 
        return view('admin.kriteria.tambah')->with('title','Tambah Kriteria'); 
    }

    public function simpan(Request $request){
        $message = [
            'id_kriteria.unique' => 'ID Kriteria sudah ada',
        ];
        $valid['id_kriteria'] = 'required|unique:kriteria';
        $valid['nama_kriteria'] = 'required';
        $valid['status_kriteria'] = 'required';
        $valid['nilai'] = 'required';
        // $valid['keterangan'] = 'required';
        $validator = Validator::make($request->all(), $valid);

        if ($validator->fails()) {
            return redirect()->route('admin.kriteria.tambah')->withErrors($validator)->withInput();
        } else {
            $obj = [
                'id_kriteria' => $request->id_kriteria,
                'nama_kriteria' => $request->nama_kriteria,
                'status_kriteria' => $request->status_kriteria,
                'nilai' => $request->nilai,
                'keterangan' => $request->keterangan
            ];
            DB::table('kriteria')->insert($obj);

            return redirect()->route('admin.kriteria')->with('status', 'Berhasil Menambah Data Kriteria');
        }
    }

    public function edit($id){
        $data['kriteria'] = DB::table('kriteria')->where('id_kriteria', $id)->first();

        return view('admin.kriteria.edit', $data)->with('title','Edit Kriteria'); 
    }

    public function update(Request $request){
        $valid['id_kriteria'] = 'required';
        $valid['nama_kriteria'] = 'required';
        $valid['status_kriteria'] = 'required';
        $valid['nilai'] = 'required';
        // $valid['keterangan'] = 'required';
        $validator = Validator::make($request->all(), $valid);

        if ($validator->fails()) {
            return redirect()->route('admin.kriteria.edit', $request->id)->withErrors($validator)->withInput();
        } else {
            $obj = [
                'id_kriteria' => $request->id_kriteria,
                'nama_kriteria' => $request->nama_kriteria,
                'status_kriteria' => $request->status_kriteria,
                'nilai' => $request->nilai,
                'keterangan' => $request->keterangan
            ];
            DB::table('kriteria')->where('id_kriteria', $request->id)->update($obj);

            return redirect()->route('admin.kriteria')->with('status', 'Berhasil Mengubah Data Kriteria');
        }
    }

    public function hapus($id){
        DB::table('kriteria')->where('id_kriteria', $id)->delete();
        DB::table('nilai')->where('id_kriteria', $id)->delete();
        DB::table('datalatih')->where('id_kriteria', $id)->delete();

        return redirect()->route('admin.kriteria')->with('status', 'Berhasil Menghapus Data Kriteria');
    }
}