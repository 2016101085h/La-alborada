@extends('auth.contenido')

@section('login')
<div class="login-box">
  <div class="login-logo">
    <a href="#" class=""><b>LA ALBORADA &nbsp;</b>30225</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form class="form-horizontal " action=" {{ route('login')}} " method="post">
         {{ csrf_field() }}
        <div class="input-group mb-3{{$errors->has('usuario' ? 'is-invalid' : '')}}">
          <input type="text" value="{{old('usuario')}}" class="form-control" placeholder="Usuario" name="usuario" id="usuario">
          <div class="input-group-append input-group-text">
              <span class="fas fa-user"></span>
          </div>
          {!!$errors->first('usuario','<span class="invalid-feedback">:message</span>')!!}
        </div>
        <div class="input-group mb-3{{$errors->has('password' ? 'is-invalid' : '')}}">
          <input type="password" class="form-control" placeholder="Contraseña" name="password" id="password">
          <div class="input-group-append input-group-text">
              <span class="fas fa-lock"></span>
          </div>
           {!!$errors->first('password','<span class="invalid-feedback">:message</span>')!!}
        </div>
        <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-warning btn-block text-uppercase ">Ingresar</button>
            </div>
          <div class="col-8 mt-3">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Recuerdame
              </label>
            </div>
          </div>
          <!-- /.col -->
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>Ingresar usando Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Ingresar usando Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="#">Olvide mi contraseña</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Registra un nuevo miembro</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
@endsection
