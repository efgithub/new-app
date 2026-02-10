<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exwork extends Model
{
    use HasFactory;

    protected $connection = 'mysql_remote';
    // ▼ 重要：如果您資料庫裡的表名稱不是 'exworks'，請在這裡指定
    // 例如：protected $table = 'ex_work';
    // 如果是用預設的複數型 (exworks)，這行可以不寫
    protected $table = 'exwork'; // 假設您的表名稱是 exwork

    // ▼ 如果您的主鍵不是 id，也要指定
    // protected $primaryKey = 'order_no';

    // ▼ 如果您不想讓 Laravel 自動維護 created_at / updated_at
    // public $timestamps = false;

    // ▼ 允許被寫入的欄位 (避免 MassAssignmentException)
    protected $guarded = [];
}
