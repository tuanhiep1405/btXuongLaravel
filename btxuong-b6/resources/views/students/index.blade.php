@extends('master')
@section('title')
    Danh sách sinh viên
@endsection
@section('content')
    <div class="container">
        <h1 class="text-center">Danh sách sinh viên</h1>

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
        <form action="{{ route('students.index') }}" method="GET">
            <div class="d-flex justify-content-end">
                <input type="text" class="form-control w-25" name="search" placeholder="Tìm kiếm theo tên hoặc lớp học"
                    value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
            </div>
        </form>
        <a class="btn btn-info " href="{{ route('students.create') }}">Create</a>
        
        <div class="table-responsive mt-3">
            <table class="table table-hover  table-striped">
                <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Lớp học</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->classroom->name }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('students.show', $student->id) }}">Show</a>
                                <a class="btn btn-warning" href="{{ route('students.edit', $student->id) }}">Edit</a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST"style="display:inline;">
                                    
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn xóa ko ?')" type="submit">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        {{ $students->links() }}
    </div>
@endsection
