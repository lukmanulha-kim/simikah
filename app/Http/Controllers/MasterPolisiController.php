<?php

namespace App\Http\Controllers;

use App\Models\kepolisianModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterPolisiController extends Controller
{
    public function data()
    {
        $polisi = DB::table('kepolisian')
                        ->get();
        return view('master.kepolisian.data', ['dataPolisi' => $polisi]);
    }

    public function add()
    {   
        
    }

    public function addProsses(Request $request)
    {
        $data = $request->input();
        DB::table('kepolisian')->insert([
            'nama_kep' => $data['kepolisian'],
            'alamat' => $data['alamat'],
            'status_k' => 'Y'
        ]);
        return redirect('master/polisi');
    }

    public function edit($id)
    {   
        $polisi = DB::table('kepolisian')
                        ->where('id_kepolisian', '=', $id)
                        ->get();
        return view('master.kepolisian.edit', ['dataPolisi' => $polisi]);
    }

    public function update(Request $request)
    {
        $data = $request->input();
        DB::table('kepolisian')
            ->where('id_kepolisian', '=', $data['id'])
            ->update([
            'nama_kep' => $data['kepolisian'],
            'alamat' => $data['alamat'],
            'status_k' => 'Y'
        ]);
        return redirect('master/polisi');
    }
}
