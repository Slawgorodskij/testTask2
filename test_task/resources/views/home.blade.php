@extends('layouts.app')

@section('content')
    <main class="main">

        <div class="performance">
            <h1 class="performance__title">{{$title}}</h1>
        </div>

        <div class="cart-product container">
            @foreach($products as $product)

                <div class="product">
                    <p class="product__item">{{$product->name}}</p>
                    <p class="product__item">{{$product->price}} рублей</p>
                    <form method="POST" enctype="multipart/form-data"
                          action="{{route('admin.store', $product)}}">
                        @csrf

                        <input hidden name="products_id" type="text"
                               value="{{ $product->id}}">

                        <input hidden name="product_price" type="number"
                               value="{{ $product->price}}">

                        <p class="product__item">Выберите количество товара</p>
                        <input name="count_product" type="number"
                               class="product__input"
                               value=1 />

                        <button class="button" type="submit" value="save">
                        купить
                        </button>

                    </form>
                </div>

            @endforeach
        </div>
    </main>
@endsection
