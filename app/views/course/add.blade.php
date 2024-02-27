@extends('layout.main')
@section('content')

@if(isset($_SESSION["errors"]) && isset($_GET["msg"]))
<ul>
    @foreach ($_SESSION["errors"] as $error)
        <li style="color: red">{{$error}}</li>
    @endforeach
</ul>
@endif

@if(isset($_SESSION["success"]) && isset($_GET["msg"]))
<span style="color: green">{{$_SESSION["success"]}}</span>
@endif

<div class="m-3">
<a class="btn btn-primary" href="{{BASE_URL}}list-course">Quay lai</a>
</div>

    <form action="{{route('post-course')}}" method="post" enctype="multipart/form-data">
        <div class="m-3">
            <input class="form-control" type="text" name="course_name" placeholder="Nhap ten khoa hoc"> <br>
        </div>

        <div class="m-3">
        <input class="form-control" type="file" name="image"> <br>
        </div>

         <div class="m-3">
        <input class="form-control" type="text" name="price" placeholder="Nhap gia khoa hoc"> <br>
        </div>

        <div class="m-3">
        <input class="form-control" type="text" name="teacher_name" placeholder="Nhap ten giang vien"> <br>
        </div>

        <div class="m-3">
        <input class="form-control" type="text" name="description" placeholder="Nhap mo ta khoa hoc"> <br>
        </div>

        <div class="m-3">
        <button class="btn btn-primary" type="submit">Them</button>
        </div>
    </form>
@endsection