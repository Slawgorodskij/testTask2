@extends('layouts.app')

@section('content')

    <main class="main">

        <div class="performance">
            <div class="admin-performance__block container">
                <h2 performance__title>{{$title}}</h2>
                <h3 performance__title> Редактирование заказа №{{$order->id}}</h3>
                <h3 performance__title> Название продукта: {{$order->products['name']}}</h3>
                <h3 performance__title> Количество продуктов в заказе: {{$order->count_product}}</h3>
            </div>
        </div>

        <div class="block container">
            <form class="block__form"
                  method="POST" enctype="multipart/form-data"
                  action="{{route('admin.update', $order)}}">
                @csrf
                @method('PUT')

                <span>Состояние заказа:</span>
                <input name="order_status" type="text"
                       class="block-form__input @error('order_status') block-form__input_error @enderror"
                       placeholder="order_status" value="{{ $order->order_status}}"/>

                @error('order_status')
                <p class="block-form__text-error">{{ $message }}</p>
                @enderror

                <button class="button" type="submit"
                        value="save">
                    Сохранить
                </button>
            </form>

            <a class="button " href="{{route('admin.index')}}">
                <span class="transition-button__text">Назад</span>
            </a>

        </div>

    </main>
@endsection
