@extends('layouts.main') {{-- 繼承剛才寫的母版 --}}

@section('title', '首頁') {{-- 填入標題 --}}

@section('content')
    <h2>歡迎來到首頁！</h2>
    <p>這裡的內容會自動出現在母版 @yield('content') 的位置。</p>
@endsection