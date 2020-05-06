<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <!-- Google検索で表示しない -->
  <meta name="robots" content="noindex" />
  <title>@yield('title')</title>
  <link rel="stylesheet" type="text/css" href="/css/html5reset-1.6.1.css" media="screen">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/css/style.css" media="screen">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="/js/style.js"></script>
</head>
<body>
  <header>
    <div class="container">
      <a href="{{ url('/items') }}">
        <div class="header-left">
          <img src="/images/logo.png">
          <p class="brown">九州の絶品グルメをあなたの食卓に</p>
        </div>
      </a>
      @auth
        <div class="header-right">
          <p class="brown">こんにちは{{ Auth::user()->name }}さん！</p>
          <div class="flex">
            @if(Auth::user()->is_admin())
              <a href="{{ url('/admin') }}">
                <div class="btn">
                  <p><i class="fas fa-align-justify fa-2x"></i></p>
                  <p>管理画面</p>
                </div>
              </a>
            @endif
            <a href="{{ url('/carts') }}">
              <div class="btn">
                <p><i class="fas fa-shopping-cart fa-2x"></i></p>
                <p>カートを見る</p>
              </div>
            </a>
            <a href="{{ url('/histories') }}">
              <div class="btn">
                <p><i class="fas fa-history fa-2x"></i></p>
                <p>購入履歴</p>
              </div>
            </a>
            <form id="logout-form" action="{{ url('/logout') }}" method="post">
              {{ csrf_field() }}
            </form>
            <a id="logout-link" href="#">
              <div class="btn">
                <p><i class="fas fa-sign-out-alt fa-2x"></i></p>
                <p>ログアウト</p>
              </div>
            </a>
          </div>
        </div>
      @endauth
    </div>
  </header> 

  @yield('content')

  @if (Session::has('modal_msg'))
    <div class="complete_msg active">
      <p>{{ session('modal_msg') }}</p>
      <p class="btn line-height2 close">OK</p>
    </div>
    <div class="modal-overlay active"></div>
  @endif
  <footer>
    <div class="container">
      <ul>
        <li><a href="#">このサイトについて</a></li>
        <li><a href="#">プライバシーポリシー</a></li>
        <li><a href="#">お問い合わせ</a></li>
        <li><a href="#">ご利用ガイド</a></li>
      </ul>
      <p><small>Copyright &copy; 博多うまか市場 All Rights Reserved.</small></p>
    </div>
  </footer>

</body>
</html>