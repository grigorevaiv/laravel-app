@extends('app')
@section('title','Login')
@section('description','Introduce tus credenciales')
@section('content')
<div class="container px-4 mx-auto py-16">
    <div class="row d-flex justify-content-center">
        <div class="col-md-5">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="correo" required/>
                </div>
                <br/>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="contraseña" required/>
                </div>
                <br/>
                <div class="form-group">
                    <input type="submit" name="login" class="btn btn-success" value="Log In">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
