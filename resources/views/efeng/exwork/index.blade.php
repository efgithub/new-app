<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>出貨請款控管表</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* 微調：讓表格內容垂直置中 */
        .table td, .table th {
            vertical-align: middle;
        }
        /* 修正分頁箭頭大小 */
        svg.w-5.h-5 { width: 20px; }
        /* 讓輸入框緊湊一點 */
        .form-control-sm, .form-select-sm {
            display: inline-block;
        }
    </style>
</head>
<body class="bg-light">

    <div class="container mt-4">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-primary text-white p-3">
                <h4 class="mb-0 fw-bold">出貨請款控管表</h4>
            </div>

            <div class="card-body p-4">

                <form action="{{ route('exwork.index') }}" method="GET" class="mb-4">

                    <div class="row g-2 align-items-center mb-2">
                        <div class="col-auto">
                            <select name="site" class="form-select">
                                <option value="">請選擇</option>
                                <option value="EF" {{ request('site') == 'EF' ? 'selected' : '' }}>EF</option>
                                <option value="PAT" {{ request('site') == 'PAT' ? 'selected' : '' }}>PAT</option>
                            </select>
                        </div>
                        <div class="col-auto">-</div>
                        <div class="col-auto">
                            <input type="text" name="keyword" class="form-control"
                                   placeholder="訂單/出貨單號"
                                   value="{{ request('keyword') }}"
                                   style="width: 250px;">
                        </div>
                    </div>

                    <div class="row g-2 align-items-center mb-2">
                        <div class="col-auto">
                            <input type="number" name="year" class="form-control"
                                   value="{{ request('year', date('Y')) }}"
                                   style="width: 80px;">
                        </div>
                        <div class="col-auto fw-bold">年</div>

                        <div class="col-auto">
                            <input type="number" name="month" class="form-control"
                                   value="{{ request('month') }}"
                                   style="width: 70px;">
                        </div>
                        <div class="col-auto fw-bold">月</div>

                        <div class="col-auto">
                            <input type="number" name="week" class="form-control"
                                   value="{{ request('week') }}"
                                   style="width: 70px;">
                        </div>
                        <div class="col-auto fw-bold">周</div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="status_all" value="all"
                                   {{ request('status') == 'all' ? 'checked' : '' }}>
                            <label class="form-check-label" for="status_all">全部</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="status_completed" value="completed"
                                   {{ request('status') == 'completed' ? 'checked' : '' }}>
                            <label class="form-check-label" for="status_completed">已完成</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="status_incomplete" value="incomplete"
                                   {{ request('status', 'incomplete') == 'incomplete' ? 'checked' : '' }}>
                            <label class="form-check-label text-primary fw-bold" for="status_incomplete">未完成</label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-dark px-4">搜尋</button>
                        <a href="{{ route('exwork.index') }}" class="btn btn-outline-secondary">更新(重置)</a>
                        <button type="button" class="btn btn-outline-dark" onclick="window.print()">列印</button>
                    </div>

                </form>

                <hr class="my-4">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>廠區</th>
                                <th>訂單編號 (orderno)</th>
                                <th>出貨單編號 (exworkno)</th>
                                <th>第一次出貨</th>
                                <th>第二次出貨</th>
                                <th>第三次出貨</th>
                                <th>出貨完成</th>
                                <th>備註</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                            <tr>
                                <td class="fw-bold">{{ $item->exWorkType }}</td>
                                <td>{{ $item->orderno }}</td>
                                <td>{{ $item->exworkno }}</td>

                                <td>{{ !empty($item->exfirst) ? date("m-d-'y", strtotime($item->exfirst)) : '' }}</td>
                                <td>{{ !empty($item->exsecond) ? date("m-d-'y", strtotime($item->exsecond)) : '' }}</td>
                                <td>{{ !empty($item->exthird) ? date("m-d-'y", strtotime($item->exthird)) : '' }}</td>

                                <td>
                                    @if($item->status == '1')
                                        <span class="badge bg-success">OK</span>
                                    @else
                                        <span class="badge bg-danger">NG</span>
                                    @endif
                                </td>
                                <td>{{ $item->exnote }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-5">
                                    目前沒有符合條件的資料
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $items->appends(request()->query())->links() }}
                </div>

            </div>
        </div>
    </div>

</body>
</html>
