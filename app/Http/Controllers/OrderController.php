<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use App\Models\OrderProduct;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get retrieve orders records
        $orders = Order::paginate(10);
        return OrderResource::collection($orders);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CreateOrderRequest $request
     * @return OrderResource
     */
    public function store(CreateOrderRequest $request)
    {
        //create a new order record
        $order = new Order();
        $order->order_number = $request->orderNumber;
        $order->item_count = $request->itemCount;
        $order->status = $request->status;
        $order->note = $request->note;
        $order->user_id = $request->userId;

        if ($order->save()) {

            foreach ($request->products as $item) {
                $orderproduct = new OrderProduct();
                $orderproduct->order_id = $order->id;
                $orderproduct->product_id = $item['productId'];
                $orderproduct->price = $item['price'];
                $orderproduct->quantity = $item['quantity'];

                $orderproduct->save();
            }
            return new OrderResource($order);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return OrderResource
     */
    public function show(Order $order)
    {
        //get specific order record by id
        $order->load(['Products']);
        return new OrderResource($order);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrderRequest $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //update a specific Category record by id
        $order->order_number = $request->orderNumber;
        $order->item_count = $request->itemCount;
        $order->status = $request->status;
        $order->note = $request->note;

        if ($order->save()) {
            return new OrderResource($order);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
//        delete a order by softDelete .
//        you are not actually removed from your database.
//        Instead, a deleted_at attribute is set on the model and inserted into the database.
//        If a model has a non-null deleted_at value, the model has been soft deleted

        if ($order->delete()) {
            return new OrderResource($order);
        }
    }


    //retrieve this order data with norlam eloquent query
    public function restore($id)
    {
        //this query didn't find our deleted data. So time to make query with withTrashed.
        // So let's have a try
        $order = Order::withTrashed()->find($id);
        $order->restore();

        return new OrderResource($order);
    }
}
