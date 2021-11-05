<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MasterPimpinanController extends Controller
{
    public function data()
    {
        $anggota = DB::table('pimpinan')
                        ->leftJoin('jabatan', 'jabatan.id_jabatan', '=', 'pimpinan.id_jabatan')
                        ->leftJoin('kepolisian', 'kepolisian.id_kepolisian', '=', 'pimpinan.id_kepolisian')
                        ->get();
        return view('master.pimpinan.data', ['dataPimpinan' => $anggota]);
    }

    public function add()
    {   
        $getKepolisian = DB::table('kepolisian')
                            ->get();
        
        $getJabatan = DB::table('jabatan')
                            ->get();

        $jsArray = "var dtangg = new Array();\n";  
        return view('master.pimpinan.add', ['getKepolisian' => $getKepolisian, 'getJabatan'=>$getJabatan, 'jsArray' => $jsArray]);
    }

    public function addProsses(Request $request)
    {
        $data = $request->input();
        $file = $request->file('foto');
        $tujuan_upload = 'style_admin/data/img_pim';
        $file->move($tujuan_upload,$file->getClientOriginalName());
        DB::table('pimpinan')->insert([
            'NRP_pimpinan' => $data['nrp'],
            'id_jabatan' => $data['jabatan'],
            'id_kepolisian' => $data['kepolisian'],
            'Nama_p' => $data['nama'],
            'thn_jabatan' => $data['tahhunjabatan'],
            'foto' => $file->getClientOriginalName(),
            'level' => $data['level'],
            'pass_pimpinan' => sha1($data['nrp']),
            'status_p' => "Y"
        ]);
        DB::table('users')->insert([
            'name' => $data['nama'],
            'level' => $data['level'],
            'email' => $data['nrp'],
            'password' => bcrypt($data['nrp']),
            'remember_token' => Str::random(60)
        ]);
        return redirect('master/pimpinan');
    }

    public function edit($id)
    {   
        $data['pimpinan'] = DB::table('pimpinan')
                        ->leftjoin('kepolisian', 'kepolisian.id_kepolisian', '=', 'pimpinan.id_kepolisian')
                        ->leftjoin('jabatan', 'jabatan.id_jabatan', '=', 'pimpinan.id_jabatan')
                        ->where('pimpinan.NRP_pimpinan', '=', $id)
                        ->get()->first();
        $getKepolisian = DB::table('kepolisian')
                        ->get();
    
        $getJabatan = DB::table('jabatan')
                        ->get();

        return view('master.pimpinan.edit', ['getKepolisian' => $getKepolisian, 'getJabatan'=>$getJabatan])->with($data);
    }

    public function update(Request $request)
    {
        $data = $request->input();
        $file = $request->file('foto');
        if ($data['password']=="") {
            $tujuan_upload = 'style_admin/data/img_pim';
            DB::table('pimpinan')
            ->where('NRP_pimpinan', '=', $data['id'])
            ->update([
                'NRP_pimpinan' => $data['nrp'],
                'id_jabatan' => $data['jabatan'],
                'id_kepolisian' => $data['kepolisian'],
                'Nama_p' => $data['nama'],
                'thn_jabatan' => $data['tahhunjabatan'],
                'level' => $data['level'],
                // 'foto' => $file->getClientOriginalName(),
                'status_p' => "Y"
            ]);
        }elseif ($data['password']!="" && $file->getClientOriginalName()!="") {
            $tujuan_upload = 'style_admin/data/img_pim';
            $file->move($tujuan_upload,$file->getClientOriginalName());
            DB::table('pimpinan')
            ->where('NRP_pimpinan', '=', $data['id'])
            ->update([
                'NRP_pimpinan' => $data['nrp'],
                'id_jabatan' => $data['jabatan'],
                'id_kepolisian' => $data['kepolisian'],
                'Nama_p' => $data['nama'],
                'thn_jabatan' => $data['tahhunjabatan'],
                'level' => $data['level'],
                'foto' => $file->getClientOriginalName(),
                'pass_pimpinan'=> sha1($data['password']),
                'status_p' => "Y"
            ]);
        }elseif ($data['password']=="" && $file->getClientOriginalName()=="") {
            DB::table('pimpinan')
            ->where('NRP_pimpinan', '=', $data['id'])
            ->update([
                'NRP_pimpinan' => $data['nrp'],
                'id_jabatan' => $data['jabatan'],
                'id_kepolisian' => $data['kepolisian'],
                'Nama_p' => $data['nama'],
                'thn_jabatan' => $data['tahhunjabatan'],
                'level' => $data['level'],
                'status_p' => "Y"
            ]);
        }
        
        return redirect('master/pimpinan');
    }
}
