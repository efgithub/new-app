<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ExworkController extends Controller
{
    public function index()
    {
        // 連結遠端資料庫並選取指定欄位，每頁 20 筆
        $data = DB::connection('mysql_efeng')
                  ->table('exwork')
                  ->select('exworktype', 'orderno', 'exfirst')
                  ->paginate(20);

        return view('efeng.exwork', compact('data'));
    }
}
