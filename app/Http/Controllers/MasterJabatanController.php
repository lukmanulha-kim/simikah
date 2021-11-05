<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterJabatanController extends Controller
{
    public function data()
    {
        $user = DB::table('jabatan')
                        ->get();
        return view('master.jabatan.data', ['dataJabatan' => $user]);
    }

    public function add()
    {   
        
    }

    public function addProsses(Request $request)
    {
        $data = $request->input();
        DB::table('jabatan')->insert([
            'nm_jabatan' => $data['jabatan']
        ]);
        return redirect('master/jabatan');
    }

    public function edit($id)
    {   
        $data['jabatan'] = DB::table('jabatan')
                        ->where('id_jabatan', '=', $id)
                        ->get()->first();
        return view('master.jabatan.edit')->with($data);
    }

    public function update(Request $request)
    {
        $data = $request->input();
        DB::table('jabatan')
            ->where('id_jabatan', '=', $data['id'])
            ->update([
            'nm_jabatan' => $data['jabatan']
        ]);
        return redirect('master/jabatan');
    }
}
