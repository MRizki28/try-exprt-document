<?php

namespace App\Http\Controllers\API;

use App\Exports\HpExport;
use App\Http\Controllers\Controller;
use App\Models\HpModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Maatwebsite\Excel\Facades\Excel;

class HpController extends Controller
{
    public function index()
    {
        $data = HpModel::all();
        return response()->json([
            'code' => 200,
            'message' => 'success get all data',
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'merek' => 'required',
            'nama' => 'required',
            'ram' => 'required',
            'penyimpanan' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message' => 'check your validation',
                'errors' => $validation->errors()
            ]);
        }

        $validated = $validation->validated();

        try {
            $data = new HpModel($validated);
            $data->uuid = Uuid::uuid4()->toString();
            $data->merek = $request->input('merek');
            $data->nama = $request->input('nama');
            $data->ram = $request->input('ram');
            $data->penyimpanan = $request->input('penyimpanan');
            $data->save();
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'failed to create data',
                'errors' => $th->getMessage()
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'success create data',
            'data' => $data
        ]);
    }

    public function getbyuuid($uuid)
    {
        $data = HpModel::where('uuid', $uuid)->first();
        if ($data != null) {
            return response()->json([
                'code' => 200,
                'message' => 'success get by uuid' ,
                'data' => $data
            ]);
        } else {
            return response()->json([
                'message' => 'data not found'
            ]);
        }
    }
    
    

    public function export()
    {
        $fileName = 'hp_data.xlsx';
        return Excel::download(new HpExport, $fileName);
    }
    
}
