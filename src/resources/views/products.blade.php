@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/products.css')}}">
@endsection

@section('content')
<div class="product-content">
    <div class="product-header">
        @if(request('keyword'))
        <h1 class="product-header__tittle">"{{request('keyword')}}"の商品一覧</h1>
        @else
        <h1 class="product-header__tittle">商品一覧</h1>
        @endif
        <a href="{{route('products.register-index')}}" class="product-header__btn">＋ 商品を追加</a>
    </div>
    <div class="product-content__inner">
        <div class="product-filter">
            <form action="/products/search" method="get" class="search-group">
                <input type="text" name="keyword" placeholder="商品名で検索" class="search-group__input">
                <button type="submit" class="search-group__btn">検索</button>
                <div class="sort-group">
                    <p class="sort-group__tittle">価格順で表示</p>
                    <select name="sort" onchange="this.form.submit()" class="sort-group__select">
                        <option value="" disabled {{request('sort') ? '' : 'selected'}} style="display:none;">価格で並び替え</option>
                        <option value="high" {{request('sort') === 'high' ? 'selected' : ''}}>高い順に表示</option>
                        <option value="low" {{request('sort') === 'low' ? 'selected' : ''}}>低い順に表示</option>
                    </select>
                </div>
            </form>
            @if(request('sort'))
            <div class="sort-modal">
                <p class="sort-modal__label">
                    {{request('sort') === 'high' ? '高い順に表示' : '低い順に表示'}}
                </p>
                <a href="{{url('/products/search')}}?keyword={{request('keyword')}}" class="sort-modal__close">✕</a>
            </div>
            @endif
        </div>
        <div class="product-list">
            @foreach($products as $product)
            <a href="{{route('products.show', ['productId' => $product->id])}}" class="product-card">
                <img src="{{asset('storage/' . $product['image'])}}" alt="商品画像" class="product-card__image">
                <div class="product-card__content">
                    <p class="product-card__name">
                        {{$product['name']}}
                    </p>
                    <p class="product-card__price">
                        ¥{{$product['price']}}
                    </p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    <div class="pagination">
        {{$products->links()}}
    </div>
</div>
@endsection