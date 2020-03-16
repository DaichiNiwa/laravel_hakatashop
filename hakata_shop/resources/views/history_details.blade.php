@extends('layouts.default')

@section('title', '購入履歴明細')

@section('content')

<main>
  <div class="container">
    <h1>購入完了</h1>
    <p>合計金額：{{ $history->history_details_sum() }}円</p>
    @foreach($history->HistoryDetails as $history_detail)
      <table>
        <tr>
          <th>商品画像</th>
          <th>商品名</th>
          <th>価格</th>
          <th>個数</th>
        </tr>
        <tr>
          <td><img src="{{ asset('storage/photos/' . $history_detail->item->image) }}"></td>
          <td>{{ $history_detail->item->name }}</td>
          <td>{{ $history_detail->purchased_price }}円</td>
          <td>{{ $history_detail->amount }}個</td>
        </tr>
      </table>
    @endforeach
    <a href="{{ url('/items') }}" class="btn link">商品一覧へ戻る</a>
  </div>
</main>
@endsection
