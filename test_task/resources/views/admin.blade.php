@extends('layouts.app')
@section('content')

    <main class="main">
        <div class="performance">
            <h1 class="performance__title">{{$title}}</h1>
        </div>
        <div class="orders container">
            <div class="order">
                <p class="order__item">номер п/п</p>
                <p class="order__item">покупатель</p>
                <p class="order__item">название продукта</p>
                <p class="order__item">кол-во</p>
                <p class="order__item">стоимость <br>(1 товара в рублях)</p>
                <p class="order__item">общая стоимость заказа</p>
                <p class="order__item">Состояние заказа</p>
                <p class="order__item"></p>
            </div>
        @foreach($orders as $order)
            <div class="order">
                <p class="order__item">{{$order->id}}</p>
                <p class="order__item">{{$order->buyers['name']}}</p>
                <p class="order__item">{{$order->products['name']}}</p>
                <p class="order__item">{{$order->count_product}}</p>
                <p class="order__item">{{$order->products['price']}}</p>
                <p class="order__item">{{$order->total_price}}</p>
                <p class="order__item">{{$order->order_status}}</p>
                <div class="order__item">
                    <div class="button button_mb-10">
                        <a href="{{route('admin.edit', $order)}}">изменить</a>
                    </div>
                    <form action="{{route('admin.destroy', $order)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="button order__button" type="submit">
                            Удалить
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
        </div>
    </main>

@endsection
