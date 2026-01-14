@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/details.css')}}">
@endsection

@section('content')
<div class="product-detail">
    <nav class="product-detail__breadcrumb">
        <a href="{{route('products.index')}}">商品一覧</a>
        <span class="breadcrumb__separator">></span>
        <span class="breadcrumb__current">商品詳細</span>
    </nav>
    <form action="{{route('products.update', ['productId' => $product->id])}}" method="post" enctype="multipart/form-data" class="product-detail__content">
        @csrf
        @method('PATCH')
        <div class="product-detail__basic">
            <div class="product-detail__image">
                <img src="{{asset('storage/' . $product['image'])}}" alt="商品画像" class="product-detail__image-preview">
                <input type="file" name="image" class="product-detail__image-input">
                @if($errors->has('image'))
                    @foreach($errors->get('image') as $message)
                        <p class="product-detail__error">{{$message}}</p>
                    @endforeach
                @endif
            </div>
            <div class="product-detail__fields">
                <p class="product-detail__label">商品名</p>
                <input type="text" name="name" value="{{old('name', $product->name)}}" placeholder="商品名を入力" class="product-detail__input">
                @if($errors->has('name'))
                    @foreach($errors->get('name') as $message)
                        <p class="product-detail__error">{{$message}}</p>
                    @endforeach
                @endif
                <p class="product-detail__label">値段</p>
                <input type="text" name="price" value="{{old('price', $product->price)}}" placeholder="値段を入力" class="product-detail__input">
                @if($errors->has('price'))
                    @foreach($errors->get('price') as $message)
                        <p class="product-detail__error">{{$message}}</p>
                    @endforeach
                @endif
                <p class="product-detail__label">季節</p>
                <fieldset class="product-detail__checkbox-group">
                    @foreach($seasons as $season)
                    <label class="product-detail__checkbox">
                        <input type="checkbox" name="seasons[]" value="{{$season->id}}" {{$product->seasons->contains($season->id) ? 'checked' : ''}}>
                        {{$season->name}}
                    </label>
                    @endforeach
                </fieldset>
                @if($errors->has('seasons'))
                    @foreach($errors->get('seasons') as $message)
                        <p class="product-detail__error">{{$message}}</p>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="product-detail__description">
            <p class="product-detail__label">商品説明</p>
            <textarea name="description" class="product-detail__textarea">{{old('description', $product->description)}}</textarea>
            @if($errors->has('description'))
                @foreach($errors->get('description') as $message)
                    <p class="product-detail__error">{{$message}}</p>
                @endforeach
            @endif
        </div>
        <div class="product-detail__btn">
            <button type="submit" class="product-detail__btn--update">変更を保存</button>
        </div>
    </form>
    <a href="{{route('products.index')}}" class="product-detail__btn--back">戻る</a>
    <form action="{{route('products.delete', ['productId' => $product->id])}}" method="post" class="product-detail__delete">
        @csrf
        @method('DELETE')
        <button class="delete__btn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
                <path d="M10 11v6"></path>
                <path d="M14 11v6"></path>
                <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path>
            </svg>
        </button>
    </form>
</div>
@endsection