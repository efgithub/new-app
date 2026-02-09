// app/Models/Exwork.php
class Exwork extends Model
{
    // ★ 強制連線到遠端
    protected $connection = 'mysql_remote';

    // 指定遠端的表名
    protected $table = 'exwork';

    // 這裡的 ID 是遠端的業務編號
}
