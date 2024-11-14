@extends('layouts.layout')

@section('title', '商品一覧')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endpush

@section('content')
<header>
    <h1>商品一覧</h1>
    <a href="{{ route('products.create') }}">+ 商品を追加</a>
</header>

<div class="container">
    <section class="product-search">
        <form action="{{ route('products.search') }}" method="GET">
            <input type="text" name="query" placeholder="商品名で検索" value="{{ request('query') }}">
            <button type="submit">検索</button>
            <label for="sort">価格順で表示</label>
            <select name="sort" id="sort" onchange="this.form.submit()">
                <option value="" {{ request('sort') ? '' : 'selected' }}>価格で並び替え</option>
                <option value="low" {{ request('sort') === 'low' ? 'selected' : '' }}>低い順</option>
                <option value="high" {{ request('sort') === 'high' ? 'selected' : '' }}>高い順</option>
            </select>
        </form>
    </section>

    <section class="product-grid">
        @if($products && $products->count() > 0)
            @foreach ($products as $product)
                <form action="{{ route('products.show', $product->id) }}" method="GET">
                    <div class="product-item">
                        <button type="submit" style="background: none; border: none; padding: 0;">
                            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                            <div class="product-info">
                                <p class="product-name">{{ $product->name }}</p>
                                <p class="product-price">¥{{ number_format($product->price) }}</p>
                            </div>
                        </button>
                    </div>
                </form>
            @endforeach
        @else
            <p>商品が見つかりません。</p>
        @endif
    </section>
</div>

<section class="pagination">
    {{ $products->appends(request()->query())->onEachSide(1)->links() }}
</section>
@endsection
