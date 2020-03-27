@extends('layouts.default')

@section('title', '商品一覧')

@section('content')

    <main>
      <div class="main_img">
        <div class="slide-btn prev">
          <i class="fas fa-chevron-circle-left fa-3x"></i>
        </div>
        <div class="slide active">
          <img src="/images/mainView.jpg" class="main_img">
        </div>
        <div class="slide">
          <img src="/images/mainView1.jpg" class="main_img">
        </div>
        <div class="slide">
          <img src="/images/mainView2.jpg" class="main_img">
        </div>
        <div class="slide">
          <img src="/images/mainView3.jpg" class="main_img">
        </div>
        <div class="slide-btn next">
          <i class="fas fa-chevron-circle-right fa-3x"></i>
        </div>
      </div>
      
      <div class="container">
        <form action="{{ url('/items') }}" method="get" id="search">
          {{ csrf_field() }}
          <p><input type="text" placeholder="商品名で検索" name="keyword"><input type="submit" class="btn fas line-height2 margin-top0" value="&#xf002; 検索"></p>
        </form>
        <div id="flex">
          @forelse($items as $item)
            <div class="item">
              <img src="{{ asset('storage/photos/' . $item->image) }}">
              <p>{{ $item->name }}</p>
              <p>{{ $item->price }}円</p>
              @if ($item->stock <= 0)
                <p class="red">売り切れ</p>
              @else
                <form method="post" action="{{ url('/carts', $item) }}">
                  {{ csrf_field() }}
                  <select name="amount">
                    @for($i = 1; $i <= 8; $i++)
                      <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                  </select>
                  <input type="submit" class="btn fas line-height2" value="&#xf07a; カートに入れる">
                </form>
              @endif
            </div>
          @empty
            <p>商品がありません。</p>
          @endforelse
        </div>
      </div>
    </main>
  </body>
@endsection