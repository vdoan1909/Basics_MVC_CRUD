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

    <form action="{{route('update-course/'.$courseDetail->id)}}" method="post" enctype="multipart/form-data">
        <div class="m-3">
        <input class="form-control" type="text" name="course_name" value="{{$courseDetail->course_name}}" placeholder="Nhap ten khoa hoc"> <br>
        </div>

        <div class="m-3">
        <input class="form-control" type="file" name="image"> 
        </div>

        <div class="m-3">
        <img width="200" src="{{BASE_URL}}images/{{ $courseDetail->image }}" alt="">
        </div>
        <br>
        <div class="m-3">
        <input class="form-control" type="text" name="price" value="{{$courseDetail->price}}" placeholder="Nhap gia khoa hoc"> <br>
        </div>

        <div class="m-3">
        <input class="form-control" type="text" name="teacher_name" value="{{$courseDetail->teacher_name}}" placeholder="Nhap ten giang vien"> <br>
        </div>

        <div class="m-3">
        <input class="form-control" type="text" name="description" value="{{$courseDetail->description}}" placeholder="Nhap mo ta khoa hoc"> <br>
        </div>

        <div class="m-3">
        <button class="btn btn-primary" type="submit">Sua</button>
        </div>

    </form>
@endsection