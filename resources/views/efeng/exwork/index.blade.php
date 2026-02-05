<!DOCTYPE html>
<html>
<head>
    <title>Exwork 查詢系統</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* 額外小技巧：防止圖片或 SVG 再次暴走 */
        svg.w-5.h-5 {
            width: 20px;
            display: inline;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">出貨請款控管表</h3>
            </div>
            <div class="card-body">
            <form action="{{ url('/efeng/exwork') }}" method="GET" class="row g-3 mb-4 p-3 border rounded bg-light">
                <div class="col-md-4">
                    <label for="orderno" class="form-label">訂單編號</label>
                    <input type="text" name="orderno" class="form-control" id="orderno" value="{{ request('orderno') }}" placeholder="輸入訂單編號...">
                </div>
                <div class="col-md-4">
                    <label for="exworktype" class="form-label">工作類型</label>
                    <input type="text" name="exworktype" class="form-control" id="exworktype" value="{{ request('exworktype') }}" placeholder="輸入類型...">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">開始查詢</button>
                    <a href="{{ url('/efeng/exwork') }}" class="btn btn-secondary ms-2">重置</a>
                </div>
            </form>

            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>訂單編號 (orderno)</th>
                        <th>工作類型 (exworktype)</th>
                        <th>第一次出貨 (exfirst)</th>
                        <th>第二次出貨 (exsecond)</th>
                        <th>第三次出貨 (exhtird)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $item)
                    <tr>
                        <td>{{ $item->exworktype }}-{{ $item->orderno }}</td>
                        <td></td>
                        <td>{{ !empty($item->exthird) ? date("m-d-'y", strtotime($item->exfirst)) : '' }}</td>
                        <td>{{ !empty($item->exsecond) ? date("m-d-'y", strtotime($item->exsecond)) : '' }}</td>
                        <td>{{ !empty($item->exthird) ? date("m-d-'y", strtotime($item->exthird)) : '' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">查無符合條件的資料</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-4">
                {{ $data->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>
