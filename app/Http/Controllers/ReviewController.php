<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Response; // ตอบกลับข้อมูล
use Illuminate\Http\Request; // รับข้อมูล
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ReviewController extends Controller
{
    /**
     * Create a new controller for User.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getAll()
    {
        // select * from mobil
        $data = DB::table('tbl_review')->get();
        // $data = DB::select("SELECT * FROM tbl_review");
        
        return response()->json($data, 200, 
        ['Content-Type' => 'application/json;charset=UTF-8', 
        'Charset' => 'utf-8',
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET, OPTIONS'
        ],JSON_UNESCAPED_UNICODE);
        
        // return response()->json(["status" => "success", "data" => $data], 200)
        //     ->header("Access-Control-Allow-Origin", "*")
        //     ->header("Access-Control-Allow-Methods", "GET, OPTIONS");
        
    }

    public function getID($id)
    {
        // select * from tbl_review where id=$id
        $data = Review::where('id', $id)->first();
        
        return response()->json($data, 200, 
        ['Content-Type' => 'application/json;charset=UTF-8', 
        'Charset' => 'utf-8',
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET, OPTIONS'
        ],JSON_UNESCAPED_UNICODE);

    }

    public function addData(Request $request)
    {
        $data = new Review();
        $dt = Carbon::now();
        
        // image upload
        if($request->hasFile('imgCover')) {

            $allowedfileExtension=['jpg','png'];
            $file = $request->file('imgCover');
            $extenstion = $file->getClientOriginalExtension();
            $check = in_array($extenstion, $allowedfileExtension);
    
            if($check){
                $name = time().$file->getClientOriginalName();
                $file->move('images', $name);
                $data->img_cover = $name;
                // 
                $data->img_url = env('APP_URL').'/Lumen_api/public/images/'.$name;
            }
        }

        $data->name = $request->name;
        $data->type_id = $request->type_id;
        $data->caption = $request->caption;
        $data->dsc = $request->dsc;
        $data->create_date = $dt->toDateTimeString();
        $data->update_date = $dt->toDateTimeString();
        $data->is_active = '1';
        
        // var_dump($data);
        // die();
        if($data->save()){
            return response()->json($data, 200, 
            ['Content-Type' => 'application/json;charset=UTF-8', 
            'Charset' => 'utf-8',
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'PUT, OPTIONS'
            ],JSON_UNESCAPED_UNICODE);
        }

    }

    public function updateData(Request $request, $id)
    {
        $data = Review::where('id', $id)->first();

        $dt = Carbon::now();
        // image upload
        if($request->hasFile('imgCover')) {
            $allowedfileExtension=['jpg','png'];
            $file = $request->file('imgCover');
            $extenstion = $file->getClientOriginalExtension();
            $check = in_array($extenstion, $allowedfileExtension);
    
            if($check){
                $name = time().$file->getClientOriginalName();
                $file->move('images', $name);
                $data->img_cover = $name;
                // 
                $data->img_url = env('APP_URL').'/Lumen_api/public/images/'.$name;
            }
        }

        $data->name = $request->name;
        $data->type_id = $request->type_id;
        $data->caption = $request->caption;
        $data->dsc = $request->dsc;
        $data->update_date = $dt->toDateTimeString();
        
        // var_dump($data);
        // die();
        if($data->save()){
            return response()->json($data, 200, 
            ['Content-Type' => 'application/json;charset=UTF-8', 
            'Charset' => 'utf-8',
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'PUT, OPTIONS'
            ],JSON_UNESCAPED_UNICODE);
        }

    }

    public function deleteData($id)
    {
        $data = Review::where('id', $id)->delete();
        return $this->responseSuccess($data);
    }

    protected function responseSuccess($res)
    {
        return response()->json(["status" => "success", "data" => $res], 200)
            ->header("Access-Control-Allow-Origin", "*")
            ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS");
    }
}