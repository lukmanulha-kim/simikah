<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterPasanganController extends Controller
{
    public function data()
    {
        $pasangan = DB::table('ca_pasangan')
                        ->get();
        return view('master.pasangan.data', ['dataPasangan' => $pasangan]);
    }

    public function add()
    {   
        $q=DB::table('ca_pasangan')->select(DB::raw('MAX(id_cpsangan) as kd_max'));
        

        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $lastNoUrut = substr($k->kd_max, 6, 4);
                $nextNoUrut = $lastNoUrut + 1;
                $kd = 'CPA.'.sprintf("%04s", $nextNoUrut);
            }
        }
        else
        {
            $kd = 'CPA.0001';
        }

        $data = array("kode" => $kd);

        return view('master.pasangan.add', array('kode' => $kd));
    }

    public function addProsses(Request $request)
    {
        $data = $request->input();
        DB::table('ca_pasangan')->insert([
            'id_cpsangan' => $data['id_cpsangan'],
            'Nama_c' => $data['Nama_c'],
            'Tempat_lhrc' => $data['Tempat_lhrc'],
            'Tanggal_lhrc' => $data['Tanggal_lhrc'],
            'Pekerjaan_c' => $data['Pekerjaan_c'],
            'Agamac' => $data['Agamac'],
            'Statusc' => $data['Statusc'],
            'Alamatc' => $data['Alamatc'],
            'Nama_ayahc' => $data['Nama_ayahc'],
            'Pekerjaan_ayahc' => $data['Pekerjaan_ayahc'],
            'Agama_ayahc' => $data['Agama_ayahc'],
            'Alamat_ayahc' => $data['Alamat_ayahc'],
            'Nama_ibuc' => $data['Nama_ibuc'],
            'Pekerjaan_ibuc' => $data['Pekerjaan_ibuc'],
            'Agama_ibuc' => $data['Agama_ibuc'],
            'Alamat_ibuc' => $data['Alamat_ibuc'],
        ]);
        return redirect('master/pasangan');
    }

    public function edit($id)
    {   
        $data['pasangan'] = DB::table('ca_pasangan')
                        ->where('id_cpsangan', '=', $id)
                        ->get()->first();
        return view('master.pasangan.edit')->with($data);
    }

    public function update(Request $request)
    {
        $data = $request->input();
        
        DB::table('ca_pasangan')
            ->where('id_cpsangan', '=', $data['id_cpsangan'])
            ->update([
                'Nama_c' => $data['Nama_c'],
                'Tempat_lhrc' => $data['Tempat_lhrc'],
                'Tanggal_lhrc' => $data['Tanggal_lhrc'],
                'Pekerjaan_c' => $data['Pekerjaan_c'],
                'Agamac' => $data['Agamac'],
                'Alamatc' => $data['Alamatc'],
                'Nama_ayahc' => $data['Nama_ayahc'],
                'Pekerjaan_ayahc' => $data['Pekerjaan_ayahc'],
                'Agama_ayahc' => $data['Agama_ayahc'],
                'Alamat_ayahc' => $data['Alamat_ayahc'],
                'Nama_ibuc' => $data['Nama_ibuc'],
                'Pekerjaan_ibuc' => $data['Pekerjaan_ibuc'],
                'Agama_ibuc' => $data['Agama_ibuc'],
                'Alamat_ibuc' => $data['Alamat_ibuc']
            ]); 
        return redirect('master/pasangan');
    }

    public static function autonumber($barang,$primary,$prefix){
        $q=DB::table($barang)->select(DB::raw('MAX(RIGHT('.$primary.',5)) as kd_max'));
        $prx=$prefix.Dateindo::convertdate();
        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = $prx.sprintf("%06s", $tmp);
            }
        }
        else
        {
            $kd = $prx."000001";
        }

        return $kd;
    }
}
