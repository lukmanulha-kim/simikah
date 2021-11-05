<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use Illuminate\Support\Str;

class MasterAnggotaController extends Controller
{
    public function data()
    {
        $anggota = DB::table('anggota')
                        ->leftJoin('kepolisian', 'anggota.id_kepolisian', '=', 'kepolisian.id_kepolisian')
                        ->leftJoin('pimpinan', 'kepolisian.id_kepolisian', '=', 'pimpinan.id_kepolisian')
                        ->where('pimpinan.level', 'kapolsek')
                        // ->groupBy('pimpinan.id_kepolisian')
                        ->get();
        return view('master.anggota.data', ['dataAnggota' => $anggota]);
    }

    public function add()
    {   
        $getPimpinan = DB::table('kepolisian')
                            ->leftJoin('pimpinan', 'kepolisian.id_kepolisian', '=', 'pimpinan.id_kepolisian')
                            ->where('pimpinan.level', 'kapolsek')
                            ->get();
        $jsArray = "var dtangg = new Array();\n";  
        return view('master.anggota.add', ['getPimpinan' => $getPimpinan, 'jsArray' => $jsArray]);
    }

    public function addProsses(Request $request)
    {
        $data = $request->input();
        DB::table('anggota')->insert([
            'NRP' => $data['NRP'],
            'id_kepolisian' => $data['id_kepolisian'],
            'Nama' => $data['Nama'],
            'Tempat_lhr' => $data['Tempat_lhr'],
            'Tanggal_lhr' => $data['Tanggal_lhr'],
            'Pekerjaan' => $data['Pekerjaan'],
            'Pangkat' => $data['Pangkat'],
            'Jabatan' => $data['Jabatan'],
            'Agama' => $data['Agama'],
            'Status' => $data['Status'],
            'Alamat' => $data['Alamat'],
            'Nama_bapak' => $data['Nama_bapak'],
            'Pekerjaan_bapak' => $data['Pekerjaan_bapak'],
            'Agama_bapak' => $data['Agama_bapak'],
            'Alamat_bapak' => $data['Alamat_bapak'],
            'Nama_ibu' => $data['Nama_ibu'],
            'Pekerjaan_ibu' => $data['Pekerjaan_ibu'],
            'Agama_ibu' => $data['Agama_ibu'],
            'Alamat_ibu' => $data['Alamat_ibu'],
            'pass_anggota' => sha1($data['NRP'])
        ]);
        DB::table('users')->insert([
            'name' => $data['Nama'],
            'level' => 'anggota',
            'email' => $data['NRP'],
            'password' => bcrypt($data['NRP']),
            'remember_token' => Str::random(60)
        ]);
        return redirect('master/anggota');
    }
    
    public function edit($id)
    {   
        $data['anggota'] = DB::table('anggota')
        ->leftJoin('kepolisian', 'kepolisian.id_kepolisian', '=', 'anggota.id_kepolisian')
        ->leftJoin('pimpinan', 'kepolisian.id_kepolisian', '=', 'pimpinan.id_kepolisian')
        ->where('anggota.NRP', '=', $id, 'AND', 'pimpinan.level', '=', 'kapolsek')
        ->get()->first();
        return view('master.anggota.edit')->with($data);
    }

    public function update(Request $request)
    {
        $data = $request->input();
        DB::table('anggota')
            ->where('NRP', '=', $data['id'])
            ->update([
                'NRP' => $data['NRP'],
                'id_kepolisian' => $data['id_kep'],
                'Nama' => $data['Nama'],
                'Tempat_lhr' => $data['Tempat_lhr'],
                'Tanggal_lhr' => $data['Tanggal_lhr'],
                'Pekerjaan' => $data['Pekerjaan'],
                'Pangkat' => $data['Pangkat'],
                'Jabatan' => $data['Jabatan'],
                'Agama' => $data['Agama'],
                'Status' => $data['Status'],
                'Alamat' => $data['Alamat'],
                'Nama_bapak' => $data['Nama_bapak'],
                'Pekerjaan_bapak' => $data['Pekerjaan_bapak'],
                'Agama_bapak' => $data['Agama_bapak'],
                'Alamat_bapak' => $data['Alamat_bapak'],
                'Nama_ibu' => $data['Nama_ibu'],
                'Pekerjaan_ibu' => $data['Pekerjaan_ibu'],
                'Agama_ibu' => $data['Agama_ibu'],
                'Alamat_ibu' => $data['Alamat_ibu']
        ]);
        return redirect('master/anggota');
    }

    public function getDataKepolisian($id)
    {
        $dataKepolisian = DB::table('kepolisian')
            ->where('id_kepolisian','=', $id)
            ->get()->first();
        return Response::json([
            'dataKepolisian' => $dataKepolisian
        ], 200);
    }
}
