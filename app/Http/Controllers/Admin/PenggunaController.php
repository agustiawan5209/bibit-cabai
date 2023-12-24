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

class PenggunaController extends Controller
{
    public function index(Request $request)
    { 
        $pengguna = DB::table('admin')->where('level', 'Petani');
        $dt_base= $pengguna->get();
        $data['pengguna'] = $dt_base;
        return view('admin.pengguna.list', $data)->with('title','List Pengguna'); 
    }

    public function edit($id){
        $data['pengguna'] = DB::table('admin')->where('id_user', $id)->first();

        return view('admin.pengguna.edit', $data)->with('title','Edit Pengguna'); 
    }

    public function update(Request $request){
        $valid['user'] = 'required';
        $validator = Validator::make($request->all(), $valid);

        if ($validator->fails()) {
            return redirect()->route('admin.pengguna.edit', $request->id)->withErrors($validator)->withInput();
        } else {
            $obj = [
                'user' => $request->user,
            ];
            if($request->pass){
                $obj['pass'] = $request->pass;
            }
            DB::table('admin')->where('id_user', $request->id)->update($obj);

            return redirect()->route('admin.pengguna')->with('status', 'Berhasil Mengubah Data Pengguna');
        }
    }
}