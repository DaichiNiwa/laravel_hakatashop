@extends('layouts.default')

@section('title', 'カート')

@section('content')

<main>
  <div class="container">
    <h1>カートの中身</h1>
    <p>合計金額：<?= $user->carts_sum() ?>円</p>
    @foreach($user->carts as $cart)
      <table>
        <tr>
          <th>商品画像</th>
          <th>商品名</th>
          <th>価格</th>
          <th>個数</th>
          <th>削除</th>
        </tr>
        <tr>
          <td><img src="{{ asset('storage/photos/' . $cart->item->image) }}"></td>
          <td>{{ $cart->item->name }}
          </td>
          <td>{{ $cart->item->price }}円</td>
          <td>
            <form action="{{ url('/carts', $cart) }}" method="post">
              {{ csrf_field() }}
              {{ method_field('patch') }}
              <input type="number" name="amount" id="number_form" min="0" value="{{ $cart->amount }}">&ensp;個
              <input type="submit" class="btn line-height2 margin-top0" value="数量変更">
            </form>
          </td>
          <td>
            <form action="{{ url('/carts', $cart) }}" method="post">
              {{ csrf_field() }}
              {{ method_field('delete') }}
              <input type="submit" class="btn line-height2 margin-top0" value="この商品を削除">
            </form>
          </td>
        </tr>
      </table>
    @endforeach
    @foreach(session('error_msgs') as $error)
      <ul>
        <li class="red">{{ $error }}</li>
      </ul>
    @endforeach
    <form action="{{ url('/histories') }}
    " method="post">
      {{ csrf_field() }}
      <input type="submit" class="btn line-height2" value="購入を確定する">
    </form>
    <a href="{{ url('/items') }}" class="btn link">商品一覧へ戻る</a>
  </div>
</main>
@endsection
