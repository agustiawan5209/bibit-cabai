<?php

namespace App\Http\Controllers\Admin;
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
        $data['pengguna'] = DB::table('admin')->where('level', 'Petani')->count();
        $data['kriteria'] = DB::table('kriteria')->count();
        $data['nilai'] = DB::table('nilai')->count();
        $data['datalatih'] = DB::table('datalatih')->groupBy('nomor')->count();
        return view('admin.beranda', $data)->with('title','Beranda'); 
    }
}