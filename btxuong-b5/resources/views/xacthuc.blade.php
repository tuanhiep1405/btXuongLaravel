@extends('master')
@section('title')
    Xác thực
@endsection
@section('content')

<h1 class="text-center">Xác thực</h1>
@if (session('message'))
    <div class="alert {{ session('alert-class', 'alert-info') }}">
        {{ session('message') }}
    </div>
@endif
    <!-- Form xác nhận giao dịch -->
<form  action="{{route('transaction.confirm')}}" method="POST" >
    @csrf
    <div class="form-group">
        <label for="confirmation_code">Mã xác nhận:</label>
        <input type="text" class="form-control" id="confirmation_code" name="confirmation_code" required>
    </div>
    <button type="submit" class="btn btn-success">Xác nhận giao dịch</button>

</form>

<!-- Nút hủy giao dịch -->
<form  action="{{route('transaction.cancel')}}" method="POST" >
    @csrf
    <button type="submit" class="btn btn-danger mt-3">Hủy Giao Dịch</button>
</form>
@endsection
