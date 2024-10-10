@extends('master')
@section('title')
    Thanh toán
@endsection
@section('content')
    
<h1 class="text-center mb-5">Thanh Toán Trực Tuyến</h1>

@if (session('message'))
    <div class="alert {{ session('alert-class', 'alert-info') }}">
        {{ session('message') }}
    </div>
@endif

<form  action="{{ route('transaction.start') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="amount">Số tiền:</label>
        <input type="number" class="form-control" id="amount" name="amount" required>
    </div>
    <div class="form-group">
        <label for="recipient_account">Tài khoản đích:</label>
        <input type="text" class="form-control" id="recipient_account" name="recipient_account" required>
    </div>
    <button type="submit" class="btn btn-primary">Bắt đầu giao dịch</button>
</form>




