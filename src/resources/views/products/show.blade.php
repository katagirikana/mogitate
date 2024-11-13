<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品詳細</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/css/show.css">
</head>
<body>
    <div class="container">
        <section class="product-detail">
            <h1><a href="{{ route('products.index') }}" class="product-list">商品一覧</a> > {{ $product->name }}</h1>

            <div class="product-info">
                <div class="product-image">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                </div>

                <div class="product-details">
                    <form action="/products/{{ $product->id }}/update" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <label for="product-name">商品名</label>
                        <input type="text" id="product-name" name="name" value="{{ old('name', $product->name) }}">
                        @error('name')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror

                        <label for="price">値段</label>
                        <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}">
                        @error('price')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror

                        <label>季節</label>
                        <div class="season-options">
                            <label><input type="checkbox" name="seasons[]" value="春" {{ is_array(old('seasons')) && in_array('春', old('seasons')) ? 'checked' : (in_array('春', $product->seasons->pluck('name')->toArray()) ? 'checked' : '') }}> 春</label>
                            <label><input type="checkbox" name="seasons[]" value="夏" {{ is_array(old('seasons')) && in_array('夏', old('seasons')) ? 'checked' : (in_array('夏', $product->seasons->pluck('name')->toArray()) ? 'checked' : '') }}> 夏</label>
                            <label><input type="checkbox" name="seasons[]" value="秋" {{ is_array(old('seasons')) && in_array('秋', old('seasons')) ? 'checked' : (in_array('秋', $product->seasons->pluck('name')->toArray()) ? 'checked' : '') }}> 秋</label>
                            <label><input type="checkbox" name="seasons[]" value="冬" {{ is_array(old('seasons')) && in_array('冬', old('seasons')) ? 'checked' : (in_array('冬', $product->seasons->pluck('name')->toArray()) ? 'checked' : '') }}> 冬</label>
                        </div>
                        @error('seasons')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror

                        <label for="description">商品説明</label>
                        <textarea id="description" name="description">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror

                        <div class="button-container">
                            <a href="/products" class="back-btn">戻る</a>
                            <button type="submit" class="update-btn">登録</button>
                        </div>
                    </form>

                    <form action="/products/{{ $product->id }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn" onclick="return confirm('本当に削除しますか？');">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
