@extends('layouts.default')

@section('title', '会員登録')

@section('content')
<main>
    <div class="container">
        <p>このサイトは制作者がプログラミングの学習のために制作したものです。実際に購入することはできません。</p>
        <p>新規登録をする際は、架空のメールアドレスを入力してください。</p>
        <p><a href="https://daichi-portfolio.com/">ポートフォリオサイトへ戻る</a></p>
        <div class="flex">
            <div>
                <h1>新規会員登録</h1>
                <form action="{{ route('register') }}" method="post">
                    {{ csrf_field() }}
                    <p>ユーザ名</p>
                    <p><input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus></p>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                    <p>メールアドレス</p>
                    <p><input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required></p>
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
                    <p>パスワード(確認）</p>
                    <p><input id="password-confirm" type="password" class="form-control" name="password_confirmation" required></p>
                    <input type="submit" class="btn line-height2" value="登録する">
                </form>
            </div>
            <a href="{{ route('login') }}" class="btn large-btn">ログインページへ移動</a>
        </div>
    </div>
</main>
@endsection
