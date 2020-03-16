@extends('layouts.default')

@section('title', 'ログイン')

@section('content')
<main>
    <div class="container">
    <div class="flex">
        <a href="{{ route('register') }}" class="btn large-btn mv_register">新規登録ページへ移動</a>
        <div>
        <h1>ログイン</h1>
        <form action="{{ route('login') }}" method="post">
             {{ csrf_field() }}
            <p>メールアドレス</p>
            <p><input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus></p>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            <p>パスワード</p>
            <p><input id="password" type="password" class="form-control" name="password" required></p>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <label>
              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> ログイン状態を保持する
            </label>
            <p><input type="submit" class="btn line-height2" value="ログイン"></p>
        </form>
        <p>管理者としてログインする場合はメールアドレス「test@test.com」、</p>
        <p>パスワード「password」でログインしてください。</p>
        <a class="btn-link" href="{{ route('password.request') }}">
          パスワードを忘れましたか？
        </a>
        </div>
    </div>
    </div>
</main>

{{--
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
