<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use DB;
use Session;
use Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Redirect;
use UserHelp;

class LoginController extends Controller
{
	public function index(){
		if(Session::get('admin_status')){
			return redirect()->route('admin.dashboard');
		}
		else if(Session::get('petani_status')){
			return redirect()->route('petani.dashboard');
		}
		return view('masuk')->with('title','Halaman Masuk'); 
	}
	
	public function prosesmasuk(Request $request){
		$customMessages = [
          'required' => 'Wajib Diisi.'
	      ];
	    $validator = Validator::make($request->all(),[
	            //......
	        'user' => 'required',
	        'pass' => 'required'
	    ], $customMessages);
	    if ($validator->fails()) {
	      return redirect()->route('masuk')->withErrors($validator)->withInput();
	    } else {
	    	$selectdb= DB::table('admin')->where('user',@$request->user)->first();
            if($selectdb)
            {
            	if(@$request->pass == $selectdb->pass)
                {
                	if($selectdb->level == 'Admin'){
                		Session::put('admin_status', true);
	                    Session::put('id_user', $selectdb->id_user);
	                    Session::put('user', $selectdb->user);
	                    Session::put('pass', $selectdb->pass); 
	                    return redirect()->route('admin.dashboard')->with('berhasil', 'Berhasil Masuk');
                	}
                	else {
                		Session::put('petani_status', true);
	                    Session::put('id_user', $selectdb->id_user);
	                    Session::put('user', $selectdb->user);
	                    Session::put('pass', $selectdb->pass); 
	                    Session::put('nama_petani', $selectdb->nama_petani);
	                    Session::put('kelompok_tani', $selectdb->kelompok_tani);
	                    Session::put('alamat', $selectdb->alamat);
	                    return redirect()->route('petani.dashboard')->with('berhasil', 'Berhasil Masuk');
                	}
                }
                else {
                	return redirect::back()->with('gagal', 'Password Salah');
                }
            }
            else {
            	return redirect::back()->with('gagal', 'Email Salah');
            }
	    }
	}

	public function prosesdaftar(Request $request){
		$message = [
            'user.unique' => 'Username sudah terdaftar',
        ];
        $valid['nama_petani'] = 'required';
        $valid['alamat'] = 'required';
        $valid['kelompok_tani'] = 'required';
        $valid['user'] = 'required|unique:admin';
        $valid['pass'] = 'required';
        $validator = Validator::make($request->all(), $valid, $message);

        if ($validator->fails()) {
            return redirect()->route('daftar')->withErrors($validator)->withInput();
        } else {
        	$obj = [
                'nama_petani' => $request->nama_petani,
                'alamat' => $request->alamat,
                'kelompok_tani' => $request->kelompok_tani,
                'user' => $request->user,
                'pass' => $request->pass,
                'level' => 'Petani'
            ];

            DB::table('admin')->insert($obj);

            return redirect()->route('masuk')->with('berhasil', 'Berhasil Mendaftar Silahkan Masuk');
        }
	}

	public function daftar(){
		if(Session::get('admin_status')){
			return redirect()->route('admin.dashboard');
		}
		else if(Session::get('petani_status')){
			return redirect()->route('petani.dashboard');
		}
		return view('daftar')->with('title','Halaman Daftar'); 
	}

	public function keluar(Request $request){
		$request->session()->flush(); 

        return redirect()->route('masuk')->with('berhasil', 'Berhasil Keluar');
	}
}