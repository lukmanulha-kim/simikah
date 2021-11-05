<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class TransIzinNikahController extends Controller
{
    public function data()
    {
        $izinNikah = DB::table('tb_mhnizinnikah')
                    ->leftJoin('anggota', 'anggota.NRP', '=', 'tb_mhnizinnikah.NRP')
                    ->leftJoin('ca_pasangan', 'ca_pasangan.id_cpsangan', '=', 'tb_mhnizinnikah.id_cpsangan')
                    ->get();
        return view('trans.izinnikah.data', ['dataIzinNikah' => $izinNikah]);
    }

    public function add()
    {   
        $getAnggota = DB::table('anggota')
                            ->get();
        
        $getCaPasangan = DB::table('ca_pasangan')
                            ->get();

        $jsArray = "var dtangg = new Array();\n";  
        return view('trans.izinnikah.add', ['getAnggota' => $getAnggota, 'getCaPasangan'=>$getCaPasangan, 'jsArray' => $jsArray]);
    }

    public function addProsses(Request $request)
    {
        $data = $request->input();
        DB::table('tb_mhnizinnikah')->insert([
            'nomor_sik' => $data['nomor_sik'],
            'dasar' => $data['dasar'],
            'nomor_dsr' => $data['nomor_dsr'],
            'tgl_dasar' => $data['tgl_dasar'],
            'perihal' => $data['perihal'],
            'NRP' => $data['NRP'],
            'id_cpsangan' => $data['id_cpsangan'],
            'status_izinr' => "Diajukan",
            'status_izins' => "Diajukan",
            'status_izinp' => "Diajukan",
        ]);
        return redirect('trans/izinnikah');
    }

    public function edit($id)
    {   
        $data['izinnikah'] = DB::table('tb_mhnizinnikah')
                        ->leftJoin('anggota', 'anggota.NRP', '=', 'tb_mhnizinnikah.NRP')
                        ->leftJoin('ca_pasangan', 'ca_pasangan.id_cpsangan', '=', 'tb_mhnizinnikah.id_cpsangan')
                        ->where('tb_mhnizinnikah.id_izin', '=', $id)
                        ->get()->first();
        $getAnggota = DB::table('anggota')
                        ->get();
    
        $getCaPasangan = DB::table('ca_pasangan')
                        ->get();
        return view('trans.izinnikah.edit', ['getAnggota' => $getAnggota, 'getCaPasangan'=>$getCaPasangan])->with($data);
    }

    public function update(Request $request)
    {
        $data = $request->input();
        DB::table('tb_mhnizinnikah')
            ->where('id_izin', '=', $data['id'])
            ->update([
                'nomor_sik' => $data['nomor_sik'],
                'dasar' => $data['dasar'],
                'nomor_dsr' => $data['nomor_dsr'],
                'tgl_dasar' => $data['tgl_dasar'],
                'perihal' => $data['perihal']
        ]);
        return redirect('trans/izinnikah');
    }

    public function delete($id)
    {   
        DB::table('tb_mhnizinnikah')->where('id_izin', '=', $id)->delete(); 
        return redirect('trans/izinnikah');
    }

    public function getDataAnggota($id)
    {
        $dataAnggota = DB::table('anggota')
            ->where('NRP','=', $id)
            ->get()->first();
        return Response::json([
            'dataAnggota' => $dataAnggota
        ], 200);
    }

    public function getDataCalon($id)
    {
        $dataCalon = DB::table('ca_pasangan')
            ->where('id_cpsangan','=', $id)
            ->get()->first();
        return Response::json([
            'dataCalon' => $dataCalon
        ], 200);
    }

    ### ACC

    public function acc()
    {
        $izinNikah = DB::table('tb_mhnizinnikah')
                    ->leftJoin('anggota', 'anggota.NRP', '=', 'tb_mhnizinnikah.NRP')
                    ->leftJoin('ca_pasangan', 'ca_pasangan.id_cpsangan', '=', 'tb_mhnizinnikah.id_cpsangan')
                    ->get();
        return view('trans.accpb.data', ['dataIzinNikah' => $izinNikah]);
    }

    public function accbagian($id)
    {
        DB::table('tb_mhnizinnikah')
            ->where('id_izin', '=', $id)
            ->update([
                'status_izinp' => "ACC"
        ]);
        return redirect('acc/bagian');
    }

    public function accizinnikah($id)
    {   
        $data['izinnikah'] = DB::table('tb_mhnizinnikah')
                        ->leftJoin('anggota', 'anggota.NRP', '=', 'tb_mhnizinnikah.NRP')
                        ->leftJoin('ca_pasangan', 'ca_pasangan.id_cpsangan', '=', 'tb_mhnizinnikah.id_cpsangan')
                        ->where('tb_mhnizinnikah.id_izin', '=', $id)
                        ->get()->first();
        return view('trans.accpb.view')->with($data);
    }

    public function accnikahpolsek()
    {
        $izinNikah = DB::table('tb_mhnizinnikah')
                    ->leftJoin('anggota', 'anggota.NRP', '=', 'tb_mhnizinnikah.NRP')
                    ->leftJoin('ca_pasangan', 'ca_pasangan.id_cpsangan', '=', 'tb_mhnizinnikah.id_cpsangan')
                    ->get();
        return view('trans.accpolsek.data', ['dataIzinNikah' => $izinNikah]);
    }

    public function nikahaccpolsek($id)
    {
        DB::table('tb_mhnizinnikah')
            ->where('id_izin', '=', $id)
            ->update([
                'status_izins' => "ACC"
        ]);
        return redirect('acc/nikah/polsek');
    }

    public function accnikahpolres()
    {
        $izinNikah = DB::table('tb_mhnizinnikah')
                    ->leftJoin('anggota', 'anggota.NRP', '=', 'tb_mhnizinnikah.NRP')
                    ->leftJoin('ca_pasangan', 'ca_pasangan.id_cpsangan', '=', 'tb_mhnizinnikah.id_cpsangan')
                    ->get();
        return view('trans.accpolres.data', ['dataIzinNikah' => $izinNikah]);
    }

    public function nikahaccpolres($id)
    {
        DB::table('tb_mhnizinnikah')
            ->where('id_izin', '=', $id)
            ->update([
                'status_izinr' => "ACC"
        ]);
        return redirect('acc/nikah/polres');
    }
}
