@extends('master')

@section('content')
    <h1 class="text-center">DANH SÁCH KHÁCH HÀNG</h1>
    @if (session()->has('success') && !session()->get('success'))
    <div class="alert alert-danger">
        {{ section()->get('error') }}
    </div>
@endif

@if (session()->has('success') && session()->get('success'))
    <div class="alert alert-info">
        Thao tác thành công
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
    <a class="btn btn-info" href="{{ route('employees.create') }}">Create</a>
    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">ID </th>
                    <th scope="col">first_name </th>
                    <th scope="col">last_name </th>
                    <th scope="col">email </th>
                    <th scope="col">date_of_birth </th>
                    <th scope="col">hire_date </th>
                    <th scope="col">is_active </th>
                    <th scope="col">address </th>
                    <th scope="col">profile_picture </th>
                    <th scope="col">Created at </th>
                    <th scope="col">updated at </th>
                    <th scope="col">Action </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $employee)
                    {{-- @dd($employee); --}}
                    <tr class="">
                        <td scope="row">{{ $employee->id }}</td>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->date_of_birth }}</td>
                        <td>{{ $employee->hire_date }}</td>
                        <td>
                            @if ($employee->is_active)
                                <span class="badge bg-primary">YES</span>
                            @else
                                <span class="badge bg-danger">NO</span>
                            @endif
                        </td>
                        <td>{{ $employee->address }}</td>
                        <td>
                            @if ($employee->profile_picture ) 
                                <img src="{{Storage::url($employee->profile_picture)}}" width="100px" alt="">
                            @endif
                           
                        </td>
                        <td>{{ $employee->create_at }}</td>
                        <td>{{ $employee->updated_at }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('employees.show', $employee) }}">Show</a>
                            <a class="btn btn-warning" href="{{ route('employees.edit', $employee) }}">edit</a>
                            
                            <form action="{{ route('employees.destroy', $employee) }}" method="POST">

                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Có chắc chắn xóa')" class="btn btn-danger">
                                    XM
                                </button>
                            </form>
                            <form action="{{ route('emloyees.forceDestroy', $employee) }}" method="POST">

                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Có chắc chắn xóa')" class="btn btn-dark">
                                    XC
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{$data->links()}}
    </div>
@endsection
