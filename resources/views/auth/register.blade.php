@extends('app')
@section('title','Register')
@section('description','Registrando usuario nuevo en el sistema')
@section('content')
<div class="container px-4 mx-auto py-16">
    <div class="row d-flex justify-content-center">
        <div class="col-md-5">
            <form action="{{ url('register') }}" method="post">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="nombre" required/>
                </div>
                <br/>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="correo" required/>
                </div>
                <br/>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="contraseña" required/>
                </div>
                <br/>
                <div class="form-group">
                    <input type="submit" name="register" class="btn btn-success" value="Registrar usuario">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
