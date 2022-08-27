<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminOrderFormRequest;
use App\Http\Requests\ApiOrderFormRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::with('buyers', 'products')->get();

        if ($order->count()) {
            return OrderResource::collection($order);
        }
        return response('Заказов нет', Response::HTTP_NOT_FOUND);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ApiOrderFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApiOrderFormRequest $request)
    {
        $data = $request->validated();
        $data['total_price'] = $data['products_price'] * $data['count_product'];
        $data['order_status'] = 'сбор';

        $newOrder = Order::create($data);

        if ($newOrder) {
          return new OrderResource($newOrder);
        }

        return response('Заказ не оформлен.', Response::HTTP_SERVICE_UNAVAILABLE);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $order = Order::with('buyers', 'products')->find($id);

        if ($order) {
            return new OrderResource($order);
        }

        return response('Заказ не найден', Response::HTTP_NOT_FOUND);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AdminOrderFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminOrderFormRequest $request, $id)
    {

        $newOrder = Order::find($id);
        $newOrder->update($request->validated());

        return new OrderResource($newOrder);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

       $order = Order::find($id)->delete();

       if ($order) {
       return response('Заказ удален', Response::HTTP_NO_CONTENT);
       }

        return response('Заказ не удален', Response::HTTP_SERVICE_UNAVAILABLE);
    }
}
