@extends('layouts.default')

@section('title', '購入履歴')

@section('content')

<main>
  <div class="container">
    <h1>購入履歴</h1>
    @if(\Auth::user()->histories->isNotEmpty())
      <table>
        <tr>
          <th>購入番号</th>
          <th>購入日時</th>
          <th>合計金額</th>
          <th>詳細</th>
        </tr>
        @foreach(\Auth::user()->histories->sortByDesc('created_at') as $history)
          <tr>
            <td>{{ $history->id }}</td>
            <td>{{ $history->created_at }}</td>
            <td>{{ $history->history_details_sum() }}円</td>
            <td><a href="{{ url('/histories', $history) }}" class="btn line-height2">詳細を見る</a></td>
          </tr>
        @endforeach
      </table>
    @else
      <p>購入履歴はありません。</p>
    @endif
    <a href="{{ url('/items') }}" class="btn link">商品一覧へ戻る</a>
  </div>
</main>
@endsection
