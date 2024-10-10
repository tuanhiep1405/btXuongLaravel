@extends('master')

@section('content')

    
        <div class="table-responsive">
            <h1>Chi tiết khách hàng :{{$employee->last_name}}</h1>
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">Tên trường</th>
                        <th scope="col">Giá trị</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employee->toArray() as $key => $value)
                    <tr class="">
                        <td scope="row">{{strtoupper($key)}}</td>
                        <td>
                            @php
                                switch ($key) {
                                    case 'is_active':
                                        echo $employee->is_active
                                        ? '<span class="badge bg-primary">YES</span>' : '<span class="badge bg-danger">NO</span>';
                                        break;
                                    
                                    default:
                                        echo $value;
                                        break;
                                }
                            @endphp
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
@endsection
