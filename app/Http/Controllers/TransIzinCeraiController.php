<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class TransIzinCeraiController extends Controller
{
    public function data()
    {
        $izinCerai = DB::table('tb_cerai')
                    ->leftJoin('tb_mhnizinnikah', 'tb_cerai.id_izin', '=', 'tb_mhnizinnikah.id_izin')
                    ->leftJoin('anggota', 'anggota.NRP', '=', 'tb_mhnizinnikah.NRP')
                    ->leftJoin('ca_pasangan', 'ca_pasangan.id_cpsangan', '=', 'tb_mhnizinnikah.id_cpsangan')
                    ->get();
        return view('trans.izincerai.data', ['dataIzinCerai' => $izinCerai]);
    }

    public function add()
    {   
        $getData = DB::table('tb_mhnizinnikah')
                    // ->select('anggota.Nama', 'pimpinan.id_kepolisian', 'tb_mhnizinnikah.id_izin')
                    ->leftJoin('anggota', 'anggota.NRP', '=', 'tb_mhnizinnikah.NRP')
                    ->leftJoin('ca_pasangan', 'ca_pasangan.id_cpsangan', '=', 'tb_mhnizinnikah.id_cpsangan')
                    ->leftJoin('kepolisian', 'anggota.id_kepolisian', '=', 'kepolisian.id_kepolisian')
                    ->leftJoin('pimpinan', 'kepolisian.id_kepolisian', '=', 'pimpinan.id_kepolisian')
                    ->leftJoin('jabatan', 'pimpinan.id_jabatan', '=', 'jabatan.id_jabatan')
                    // ->groupBy('pimpinan.id_kepolisian')
                    ->get();

        $jsArray = "var dtangg = new Array();\n";  
        return view('trans.izincerai.add', ['getData' => $getData, 'jsArray' => $jsArray]);
    }

    public function addProsses(Request $request)
    {
        $data = $request->input();
        DB::table('tb_cerai')->insert([
            'nomor_sic' => $data['nomor_sic'],
            'dasar_c' => $data['dasar_c'],
            'nomor_dsrc' => $data['nomor_dsrc'],
            'tgl_dsr' => $data['tgl_dsr'],
            'perihal_c' => $data['perihal'],
            'alasan' => $data['alasan'],
            'id_izin' => $data['id_izin'],
            'statuscp' => "Diajukan",
            'statuscs' => "Diajukan",
            'statuspb' => "Diajukan",
        ]);
        return redirect('trans/izincerai');
    }

    public function edit($id)
    {   
        $data['dataCerai'] = DB::table('tb_cerai')
                    ->leftJoin('tb_mhnizinnikah', 'tb_cerai.id_izin', '=', 'tb_mhnizinnikah.id_izin')
                    ->leftJoin('anggota', 'anggota.NRP', '=', 'tb_mhnizinnikah.NRP')
                    ->leftJoin('ca_pasangan', 'ca_pasangan.id_cpsangan', '=', 'tb_mhnizinnikah.id_cpsangan')
                    ->where('tb_cerai.id_cerai','=',$id)
                    ->get()->first();
        return view('trans.izincerai.edit')->with($data);
    }

    public function update(Request $request)
    {
        $data = $request->input();
        DB::table('tb_cerai')
            ->where('id_cerai', '=', $data['id'])
            ->update([
                'nomor_sic' => $data['nomor_sic'],
                'dasar_c' => $data['dasar_c'],
                'nomor_dsrc' => $data['nomor_dsrc'],
                'tgl_dsr' => $data['tgl_dsr'],
                'perihal_c' => $data['perihal'],
                'alasan' => $data['alasan']
        ]);
        return redirect('trans/izincerai');
    }

    public function delete($id)
    {   
        DB::table('tb_cerai')->where('id_cerai', '=', $id)->delete(); 
        return redirect('trans/izincerai');
    }

    public function get_dataCerai($id)
    {
        $dataCerai = DB::table('tb_mhnizinnikah')
            // ->select('anggota.Nama', 'pimpinan.id_kepolisian', 'tb_mhnizinnikah.id_izin')
            ->leftJoin('anggota', 'anggota.NRP', '=', 'tb_mhnizinnikah.NRP')
            ->leftJoin('ca_pasangan', 'ca_pasangan.id_cpsangan', '=', 'tb_mhnizinnikah.id_cpsangan')
            ->leftJoin('kepolisian', 'anggota.id_kepolisian', '=', 'kepolisian.id_kepolisian')
            ->leftJoin('pimpinan', 'kepolisian.id_kepolisian', '=', 'pimpinan.id_kepolisian')
            ->leftJoin('jabatan', 'pimpinan.id_jabatan', '=', 'jabatan.id_jabatan')
            ->where('tb_mhnizinnikah.id_izin','=',$id)
            ->get()->first();
        return Response::json([
            'dataCerai' => $dataCerai
        ], 200);
    }

    ### ACC

    public function accceraipimpinan()
    {
        $izinCerai = DB::table('tb_cerai')
                    ->leftJoin('tb_mhnizinnikah', 'tb_cerai.id_izin', '=', 'tb_mhnizinnikah.id_izin')
                    ->leftJoin('anggota', 'anggota.NRP', '=', 'tb_mhnizinnikah.NRP')
                    ->leftJoin('ca_pasangan', 'ca_pasangan.id_cpsangan', '=', 'tb_mhnizinnikah.id_cpsangan')
                    ->get();
        return view('trans.accpb.cerai', ['dataIzinCerai' => $izinCerai]);
    }

    public function accceraibagian($id)
    {
        DB::table('tb_cerai')
            ->where('id_cerai', '=', $id)
            ->update([
                'statuspb' => "ACC"
        ]);
        return redirect('acc/cerai/pimpinan');
    }

    public function accizincerai($id)
    {   
        $data['izincerai'] = DB::table('tb_cerai')
                        ->leftJoin('tb_mhnizinnikah', 'tb_cerai.id_izin', '=', 'tb_mhnizinnikah.id_izin')
                        ->leftJoin('anggota', 'anggota.NRP', '=', 'tb_mhnizinnikah.NRP')
                        ->leftJoin('ca_pasangan', 'ca_pasangan.id_cpsangan', '=', 'tb_mhnizinnikah.id_cpsangan')
                        ->where('tb_cerai.id_izin', '=', $id)
                        ->get()->first();
        return view('trans.accpb.ceraiview')->with($data);
    }

    public function accceraipolsek()
    {
        $izinCerai = DB::table('tb_cerai')
                    ->leftJoin('tb_mhnizinnikah', 'tb_cerai.id_izin', '=', 'tb_mhnizinnikah.id_izin')
                    ->leftJoin('anggota', 'anggota.NRP', '=', 'tb_mhnizinnikah.NRP')
                    ->leftJoin('ca_pasangan', 'ca_pasangan.id_cpsangan', '=', 'tb_mhnizinnikah.id_cpsangan')
                    ->get();
        return view('trans.accpolsek.cerai', ['dataIzinCerai' => $izinCerai]);
    }

    public function ceraiaccpolsek($id)
    {
        DB::table('tb_cerai')
            ->where('id_cerai', '=', $id)
            ->update([
                'statuscs' => "ACC"
        ]);
        return redirect('acc/cerai/polsek');
    }

    public function accceraipolres()
    {
        $izinCerai = DB::table('tb_cerai')
                    ->leftJoin('tb_mhnizinnikah', 'tb_cerai.id_izin', '=', 'tb_mhnizinnikah.id_izin')
                    ->leftJoin('anggota', 'anggota.NRP', '=', 'tb_mhnizinnikah.NRP')
                    ->leftJoin('ca_pasangan', 'ca_pasangan.id_cpsangan', '=', 'tb_mhnizinnikah.id_cpsangan')
                    ->get();
        return view('trans.accpolres.cerai', ['dataIzinCerai' => $izinCerai]);
    }

    public function ceraiaccpolres($id)
    {
        DB::table('tb_cerai')
            ->where('id_cerai', '=', $id)
            ->update([
                'statuscp' => "ACC"
        ]);
        return redirect('acc/cerai/polres');
    }
}
