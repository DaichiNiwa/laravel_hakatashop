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
@endsection
