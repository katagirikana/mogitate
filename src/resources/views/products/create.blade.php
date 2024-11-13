<!DOCTYPE html>  
<html lang="ja">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>商品情報更新</title>  
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">  
</head>  
<body>  
    <div class="form-container">  
        <h1 class="form-title">商品登録</h1>  

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="product-form">  
            @csrf  

            <label for="productName" class="label">  
                商品名 <span class="required-text">必須</span>  
            </label>  
            <input type="text" name="name" id="productName" class="input-field" placeholder="商品名を入力">  
            @error('name')  
                <span class="error-message">{{ $message }}</span>  
            @enderror  

            <label for="productPrice" class="label">  
                価格 <span class="required-text">必須</span>  
            </label>  
            <input type="text" name="price" id="productPrice" class="input-field" placeholder="価格を入力">  
            @error('price')  
                <span class="error-message">{{ $message }}</span>  
            @enderror  

            <label for="productImage" class="label">  
                商品画像 <span class="required-text">必須</span>  
            </label>  
            <input type="file" name="image" id="productImage" class="input-field">  
            @error('image')  
                <span class="error-message">{{ $message }}</span>  
            @enderror  

            <fieldset class="season-fieldset">  
                <legend class="label">季節 <span class="required-text">必須</span></legend>  
                <label class="season-label">  
                    <input type="checkbox" name="seasons[]" value="spring" {{ is_array(old('seasons')) && in_array('spring', old('seasons')) ? 'checked' : '' }}> 春  
                </label>  
                <label class="season-label">  
                    <input type="checkbox" name="seasons[]" value="summer" {{ is_array(old('seasons')) && in_array('summer', old('seasons')) ? 'checked' : '' }}> 夏  
                </label>  
                <label class="season-label">  
                    <input type="checkbox" name="seasons[]" value="fall" {{ is_array(old('seasons')) && in_array('fall', old('seasons')) ? 'checked' : '' }}> 秋  
                </label>  
                <label class="season-label">  
                    <input type="checkbox" name="seasons[]" value="winter" {{ is_array(old('seasons')) && in_array('winter', old('seasons')) ? 'checked' : '' }}> 冬  
                </label>  
            </fieldset>  
            @error('seasons')  
                <span class="error-message">{{ $message }}</span>  
            @enderror  

            <label for="productDescription" class="label-optional">  
                商品説明  
            </label>  
            <textarea name="description" id="productDescription" class="textarea-field" placeholder="商品説明を入力">{{ old('description') }}</textarea>  
            @error('description')  
                <span class="error-message">{{ $message }}</span>  
            @enderror  

            <div class="button-container">  
                <a href="{{ route('products.index') }}" class="button-cancel">戻る</a>  
                <button type="submit" class="button-submit">登録</button>  
            </div>  
        </form>  
    </div>  
</body>  
</html>
