<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExworkController extends Controller
{
    //
    public function index()
    {
        // 抓取 204 的 efeng 資料庫
        $data = DB::connection('mysql_efeng')
                  ->table('exwork')
                  ->select('id', 'exworktype', 'orderno', 'exfirst', 'exsecond', 'exthird')
                  ->orderBy('id', 'desc')
                  ->paginate(20);

        return view('efeng.exwork.index', compact('data'));
    }
}
