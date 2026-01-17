@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/registers.css')}}">
@endsection

@section('content')
<div class="product-register">
    <h1 class="product-register__heading">商品登録</h1>
    <form action="{{route('products.register')}}" method="post" enctype="multipart/form-data" class="product-register__form">
        @csrf
        <div class="product-register__form--item">
            <span class="product-register__form--title">商品名</span>
            <span class="product-register__form--required">必須</span>
            <input type="text" name="name" value="{{old('name')}}" placeholder="商品名を入力" class="product-register__form--input">
            <p class="product-register__form--error">
                @error('name')
                {{$message}}
                @enderror
            </p>
        </div>
        <div class="product-register__form--item">
            <span class="product-register__form--title">値段</span>
            <span class="product-register__form--required">必須</span>
            <input type="text" name="price" value="{{old('price')}}" placeholder="値段を入力" class="product-register__form--input">
            <p class="product-register__form--error">
                @error('price')
                {{$message}}
                @enderror
            </p>
        </div>
        <div class="product-register__form--item">
            <span class="product-register__form--title">商品画像</span>
            <span class="product-register__form--required">必須</span>
            <div class="product-register__image--preview">
                <img id="imagePreview" src="{{isset($product) && $product->image ? asset('storage/' . $product->image) : ''}}" alt="商品画像">
            </div>
            <input type="file" name="image" accept="image/*" onchange="previewImage(this)" class="product-register__image--input">
            <p class="product-register__form--error">
                @error('image')
                {{$message}}
                @enderror
            </p>
        </div>
        <div class="product-register__form--item">
            <span class="product-register__form--title">季節</span>
            <span class="product-register__form--required">必須</span>
            <span class="product-register__form--option">複数選択可</span>
            <fieldset class="product-register__checkbox-group">
                @foreach($seasons as $season)
                <label class="product-register__checkbox">
                    <input type="checkbox" name="seasons[]" value="{{$season->id}}" {{in_array($season->id, old('seasons', [])) ? 'checked' : ''}}>{{$season->name}}
                </label>
                @endforeach
            </fieldset>
            <p class="product-register__form--error">
                @error('seasons')
                {{$message}}
                @enderror
            </p>
        </div>
        <div class="product-register__form--item">
            <span class="product-register__form--title">商品説明</span>
            <span class="product-register__form--required">必須</span>
            <textarea name="description" class="product-register__form--textarea">{{old('description')}}</textarea>
            <p class="product-register__form--error">
                @error('description')
                {{$message}}
                @enderror
            </p>
        </div>
        <div class="product-register__btn">
            <button type="submit" class="product-register__btn--submit">登録</button>
        </div>
    </form>
    <a href="{{route('products.index')}}" class="product-register__btn--back">戻る</a>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(input)
    {
        if(input.files && input.files[0])
        {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('imagePreview').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush