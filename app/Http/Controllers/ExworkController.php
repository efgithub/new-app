<?php

namespace App\Http\Controllers; // 1. 定義門牌號碼

use Illuminate\Http\Request;
use App\Models\Exwork; // 2. 引用 Exwork 模型

class ExworkController extends Controller // 3. 定義類別名稱 (必須跟檔名一樣)
{
    // ▼▼▼ 您的 index 函式必須包在這個大括號裡面 ▼▼▼
    public function index(Request $request)
    {
        // 1. 建立查詢建構器
        $query = Exwork::query();

        // ➤ 基礎條件：參照 VB 程式碼 (AND iscancelled = 0)
        // 除非特殊需求，否則不顯示已取消的單據
        $query->where('iscancelled', 0);

        // 2. 篩選：廠區 (對應 exWorkType)
        if ($request->filled('site')) {
            $query->where('exWorkType', $request->site);
        }

        // 3. 篩選：關鍵字 (訂單編號 orderno 或 出貨單號 exworkno)
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('orderno', 'like', "%{$keyword}%")
                  ->orWhere('exworkno', 'like', "%{$keyword}%");
            });
        }

        // 4. 篩選：年 / 月 / 週 (直接對應資料庫欄位)
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }
        if ($request->filled('month')) {
            $query->where('month', $request->month);
        }
        if ($request->filled('week')) {
            $query->where('week', $request->week);
        }

        // 5. 篩選：狀態 (status)
        // VB 邏輯：Value 1=已完成, 2=未完成 (預設)
        // VB SQL: WHERE status <> '1' (代表未完成)

        $status = $request->input('status', 'incomplete'); // 預設未完成

        if ($status == 'completed') {
            // 已完成：status 等於 '1'
            $query->where('status', '1');
        } elseif ($status == 'incomplete') {
            // 未完成：status 不等於 '1' (包含 NULL 或其他值)
            $query->where(function($q) {
                $q->where('status', '!=', '1')
                  ->orWhereNull('status');
            });
        }
        // 如果是 'all'，就不加條件

        // 6. 排序 (VB: ORDER BY exworkno ASC)
        $items = $query->orderBy('exworkno', 'asc')->paginate(20);

        return view('efeng.exwork.index', compact('items'));
        //return view('efeng.exwork.index', compact('items'));
    }
}
