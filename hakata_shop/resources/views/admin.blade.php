@extends('layouts.default')

@section('title', '商品管理')

@section('content')
<main>
  <div class="container">
    <div class="register">
      <h1>商品管理</h1>
      <h2>新規商品追加</h2>
      <form method="post" action="{{ url('/items') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <p>名前&emsp;: <input type="text" name="name" value="{{ old('name') }}"></p>
        <p>値段&emsp;: <input type="number" name="price" min="0" value="{{ old('price') }}">&ensp;円</p>
        <p>在庫数: <input type="number" name="stock" min="0" value="{{ old('stock') }}">&ensp;個</p>
        <p>画像&emsp;: <input type="file" name="image"></p>
        <p>
          <select name='status'>
            <option {{ old('status') === '1' ? 'selected' : '' }} value="1">公開</option>
            <option {{ old('status') === '0' ? 'selected' : '' }} value="0">非公開</option>
          </select>
        </p>
        <input type="submit" class="btn line-height2" value="商品を追加">
      </form>
      @foreach($errors->all(); as $error)
        <ul>
          <li class="red">{{ $error }}</li>
        </ul>
      @endforeach
    </div>

    <h2>商品情報変更</h2>
    <table>
      <tr>
        <th>商品画像</th>
        <th>商品名</th>
        <th>価格</th>
        <th>在庫数</th>
        <th>ステータス</th>
        <th>商品の削除</th>
      </tr>
      @foreach ($items as $item)
          <tr @if($item->status === '0') class="status_fault" @endif>
            <td><img src="{{ asset('storage/photos/' . $item->image) }}"></td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->price }}円</td>
            <td>
              <form method="post" action="{{ url('/items', $item) }}">
                {{ csrf_field() }}
                {{ method_field('patch') }}
                <input type="number" name="stock" min="0" id="number_form" value="{{ $item->stock }}">&ensp;個
                <input type="submit" class="btn line-height2" value="変更">
              </form>
            </td>
            <td>
              @if ($item->status === '1')
                <p>公開</p>
              @elseif($item->status === '0')
                <p>非公開</p>
              @endif
              <form method="post" action="{{ url('/items', $item) }}">
                {{ csrf_field() }}
                {{ method_field('patch') }}
                <input readonly type="hidden"  name="status" value="{{ $item->status === '0' ? 1 : 0 }}">
                <input type="submit" class="btn line-height2" value="ステータス変更">
              </form>
            </td>
            <td>
              <form method="post" action="{{ url('/items', $item) }}">
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <input type="submit" class="btn line-height2" value="商品を削除">
              </form>
            </td>
          </tr>
      @endforeach
    </table>
  </div>
</main>
@endsection


