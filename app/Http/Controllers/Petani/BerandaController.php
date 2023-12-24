<?php

namespace App\Http\Controllers\Petani;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use DB;
use Session;
use Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DateTimeZone;
use DateInterval;
use DatePeriod;
use UserHelp;
use DateTime;
use File;

class BerandaController extends Controller
{
    public function index(){
        return view('petani.beranda')->with('title','Beranda'); 
    }
    public function password(){
        return view('petani.password')->with('title','Rubah Password'); 
    }
    public function passwordupdate(Request $request){
        $valid['pass'] = 'required';
        $validator = Validator::make($request->all(), $valid);

        if ($validator->fails()) {
            return redirect()->route('petani.password', $request->id)->withErrors($validator)->withInput();
        } else {
            $obj = [
                'pass' => $request->pass,
            ];
            DB::table('admin')->where('id_user', Session::get('id_user'))->update($obj);

            return redirect()->route('petani.password')->with('status', 'Berhasil Mengubah Password');
        }
    }
}