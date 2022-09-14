<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminOrderFormRequest;
use App\Http\Requests\OrderFormRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $orders = Order::with('buyers', 'products')->get();

        return view('admin', [
            'title'  => 'Страница АДМИНИСТРАТОРА',
            'orders' => $orders
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrderFormRequest  $request
     * @return Response
     */
    public function store(OrderFormRequest $request)
    {
        $data = $request->validated();
        $data['buyers_id'] = rand(1, 10); //вместо выбора актуального покупателя
        $data['total_price'] = $data['product_price'] * $data['count_product'];
        $data['order_status'] = 'сбор';

       Order::create($data);

        return to_route('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
       $order = Order::with('products')->find($id);

       return view('updateOrder', [
           'title'=>'Страница администратора',
           'order'=> $order,
       ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AdminOrderFormRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(AdminOrderFormRequest $request, $id)
    {
        $order = Order::find($id);
        $order->update($request->validated());
        return to_route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //осталось загадкой, что делаю не так
        //иногда принимает объект иногда (как сейчас нет).
        //  @param  Order $order - остался нераспознаным

        Order::find($id)->delete();

        return to_route('admin.index');
    }
}
