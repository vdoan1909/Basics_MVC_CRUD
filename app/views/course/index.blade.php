@extends('layout.main')
@section('content')

@if(isset($_SESSION['success']) && isset($_GET["msg"]))
<span style="color: green">{{$_SESSION['success']}}</span>
@endif

<a class="btn btn-primary" href="{{BASE_URL}}add-course">Them moi</a>

<table class="table table-hover" border="1">
    <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Image</th>
        <th>Price</th>
        <th>Teacher Name</th>
        <th>Description</th>
        <th>Action</th>

    </thead>
    <tbody>
         @foreach($courses as $course)
            <tr>
                <td>{{ $course->id }}</td>
                <td>{{ $course->course_name }}</td>
                <td>
                    <img width="150" src="{{BASE_URL}}images/{{ $course->image }}" alt="">
                </td>
                <td>{{ $course->price }}</td>
                <td>{{ $course->teacher_name }}</td>
                <td>{{ $course->description }}</td>
                <th>
                    <a class="btn btn-warning" href="{{BASE_URL}}course-detail/{{$course->id}}">Sửa</a>
                    <a class="btn btn-danger" onclick="return confirm('Xoa la mat luon ??')" href="{{BASE_URL}}delete-course/{{$course->id}}">Xóa</a>
                </th>
            </tr>
        @endforeach
    </tbody>

</table>
@endsection
