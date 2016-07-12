@extends('admin.layouts.master')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" action="{{ url('/___login__') }}">
                            {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group">
                                    <input id="email" type="email" class="form-control" name="email" placeholder="E-mail" autofocus>
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" value="">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-success btn-block"> Submit </button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection