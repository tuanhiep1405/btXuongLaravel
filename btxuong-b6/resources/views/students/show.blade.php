@extends('master')
@section('title')
   Thông tin sinh viên
@endsection

@section('content')
<div class="container">
    <h1 class="my-4">Thông tin sinh viên: {{ $student->name }}</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Chi tiết sinh viên</h5>
            <p>Email: {{ $student->email }}</p>
            <p>Lớp học: {{ $student->classroom->name }} (Giáo viên: {{ $student->classroom->teacher_name }})</p>

            <h5 class="mt-4">Thông tin hộ chiếu</h5>
            <p>Số hộ chiếu: {{ $student->passport->passport_number }}</p>
            <p>Ngày cấp: {{ $student->passport->issued_date }}</p>
            <p>Ngày hết hạn: {{ $student->passport->expiry_date }}</p>

            <h5 class="mt-4">Các môn học đã đăng ký</h5>
            <ul class="list-group">
                @foreach($student->subjects as $subject)
                    <li class="list-group-item">{{ $subject->name }} ({{ $subject->credits }} tín chỉ)</li>
                @endforeach
            </ul>
        </div>
    </div>
    <a href="{{ route('students.index') }}" class="btn btn-secondary mt-4">Quay lại</a>
    <a class="btn btn-warning mt-4" href="{{ route('students.edit', $student->id) }}">Edit</a>
</div>
@endsection
