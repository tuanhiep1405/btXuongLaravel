@extends('master')
@section('title')
    Edit
@endsection
@section('content')
<div class="container">
    <h1 class="text-center">Chỉnh sửa sinh viên</h1>

    @if (session()->has('success') && !session()->get('success'))
    <div class="alert alert-danger">
        {{ section()->get('error') }}
    </div>
@endif

@if (session()->has('success') && session()->get('success'))
    <div class="alert alert-info">
       {{session()->get('success')}}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Tên sinh viên</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $student->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ $student->email }}" required>
        </div>

        <div class="mb-3">
            <label for="classroom_id" class="form-label">Lớp học</label>
            <select id="classroom_id" name="classroom_id" class="form-select" required>
                @foreach($classrooms as $classroom)
                    <option value="{{ $classroom->id }}" {{ $student->classroom_id == $classroom->id ? 'selected' : '' }}>
                        {{ $classroom->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="passport_number" class="form-label">Số hộ chiếu</label>
            <input type="text" id="passport_number" name="passport_number" class="form-control" value="{{ $student->passport->passport_number }}" required>
        </div>

        <div class="mb-3">
            <label for="issued_date" class="form-label">Ngày cấp</label>
            <input type="date" id="issued_date" name="issued_date" class="form-control" value="{{ $student->passport->issued_date }}" required>
        </div>

        <div class="mb-3">
            <label for="expiry_date" class="form-label">Ngày hết hạn</label>
            <input type="date" id="expiry_date" name="expiry_date" class="form-control" value="{{ $student->passport->expiry_date }}" required>
        </div>

        <div class="mb-3">
            <label for="subjects" class="form-label">Môn học</label>
            <select id="subjects" name="subjects[]" class="form-select" multiple required>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ $student->subjects->contains($subject->id) ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection
