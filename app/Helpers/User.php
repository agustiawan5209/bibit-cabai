<?php
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use UserHelp;
 
class User {

    public static function custom_echo($x, $length)
    {
      if(strlen($x)<=$length)
      {
        echo $x;
      }
      else
      {
        $y=substr($x,0,$length) . '...';
        echo $y;
      }
    }

    public static function slugify($text, string $divider = '-')
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public static function bulan_tahun($tanggal)
    {
        $bulan = array (1 =>   'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'Mei',
                    'Jun',
                    'Jul',
                    'Agust',
                    'Sept',
                    'Okt',
                    'Nov',
                    'Des'
                );
        $split2 = explode('-', $tanggal);
        return $bulan[ (int)$split2[0] ] . ' ' . $split2[1];
    }

	public static function tgl_indo($tanggal, $waktu = false)
    {
        $bulan = array (1 =>   'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                );
        $split2 = explode('-', $tanggal);
        return $split2[2] . ' ' . $bulan[ (int)$split2[1] ] . ' ' . $split2[0];
    }


	public static function tanggal_indo($tanggal, $waktu = false)
    {
        $bulan = array (1 =>   'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                );

        if($waktu == false){
            $split = explode(' ', $tanggal);
            $split2 = explode('-', $split[0]);
            return $split2[2] . ' ' . $bulan[ (int)$split2[1] ] . ' ' . $split2[0];
        }
        else {
            $split = explode(' ', $tanggal);
            $split2 = explode('-', $split[0]);
            return $split2[2] . ' ' . $bulan[ (int)$split2[1] ] . ' ' . $split2[0].' '.$split[1];
        }
    }

    public static function mktimeWaktu($datestar,$dateend)
    {
        $start          =   new Carbon($datestar);
        $end            =   new Carbon($dateend);
        //mktime(date("H"), date(“i”), date(“s”), date(“m”), date(“d”), date(“Y”));
        $jam_start      =   $start->format('H');
        $menit_start    =   $start->format('i');
        $detik_start    =   $start->format('s');
        $bulan_start    =   $start->format('m');
        $hari_start     =   $start->format('d');
        $tahun_start    =   $start->format('Y');

        $jam_end        =   $end->format('H');
        $menit_end      =   $end->format('i');
        $detik_end      =   $end->format('s');
        $bulan_end      =   $end->format('m');
        $hari_end       =   $end->format('d');
        $tahun_end      =   $end->format('Y');
        $waktu_start    =   mktime($jam_start,$menit_start,$detik_start,$bulan_start,$hari_start,$tahun_start);
        $waktu_end      =   mktime($jam_end,$menit_end,$detik_end,$bulan_end,$hari_end,$tahun_end);
        $selisih_waktu  =   $waktu_end-$waktu_start;
        return $selisih_waktu;
    }
    public static function RentanWaktu($selisih_waktu)
    {


                $rangeWaktu['jam']      = floor($selisih_waktu/3600);
                $sisa                   = $selisih_waktu % 3600;
                $rangeWaktu['menit']    = floor($sisa/60);
                $sisa                   = $sisa % 60;
                $rangeWaktu['detik']    = floor($sisa/1);
                return $rangeWaktu;

    }

    public static function Waktu_History($date)
    {
        

        $dateend        =Carbon::now()->format('Y-m-d H:i:s');
        $datestar       =Carbon::parse($date)->format('Y-m-d H:i:s');
        $selisihWaktu   =UserHelp::mktimeWaktu($datestar,$dateend);
        $selisihWaktu   =UserHelp::RentanWaktu($selisihWaktu);
        $waktu          ='';

        if($selisihWaktu['jam'] < 24)
        {

                if($selisihWaktu['jam'] <1)
                {
                    $waktu=$selisihWaktu['menit'].' Menit yang lalu';
                }
                else
                {
                    $waktu=$selisihWaktu['jam'].' Jam yang lalu';
                }
        }
        else
        {
            $hari=ceil($selisihWaktu['jam']/24);
            if($hari<7)
            {
                $waktu=$hari.' Hari yang Lalu';

            }
            else
            {
                $waktu=UserHelp::keIndonesia($datestar,true,false);
            }
        }

        return $waktu;


    }  

          public static function keIndonesia($Carbon,$date=false,$time=false)
    {
        
        if(preg_match("/[a-z]/", $Carbon)==true)
        {
            return;
        }
        $dt = new Carbon($Carbon);

        setlocale(LC_TIME, 'IND');
        if($date==true && $time==false)
        {

            $tanggal='%d %B %Y';
            $dt_=str_replace('Pebruari', 'Februari', $dt->formatLocalized($tanggal));
            return $dt_;
        }
        elseif($date==true && $time==true)
        {
            $tanggal='%d %B %Y %H:%M:%S';
            $dt_=str_replace('Pebruari', 'Februari', $dt->formatLocalized($tanggal));
            return $dt_;
        }
        elseif($date==false && $time==true)
        {
            $tanggal='%H:%M:%S';
            $dt_=str_replace('Pebruari', 'Februari', $dt->formatLocalized($tanggal));
            return $dt_;
        }
        elseif($date==false && $time==false)
        {
            $tanggal='%d %B %Y %H:%M:%S';
            $dt_=str_replace('Pebruari', 'Februari', $dt->formatLocalized($tanggal));
            return $dt_;
        }

        
    }

}