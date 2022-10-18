<?php

namespace App\Http\Controllers;

use App\Models;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
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
        $data = DB::table('mobil')->get();
        // $data = DB::select("SELECT * FROM mobil");
        
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
        return $this->responseSuccess('Get ID Data' . $id);
    }

    public function addData()
    {
        return $this->responseSuccess('Add Data');
    }

    public function updateData($id)
    {
        return $this->responseSuccess('Update Data' . $id);
    }

    public function deleteData($id)
    {
        return $this->responseSuccess('Delete Data' . $id);
    }

    protected function responseSuccess($res)
    {
        return response()->json(["status" => "success", "data" => $res], 200)
            ->header("Access-Control-Allow-Origin", "*")
            ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS");
    }
}