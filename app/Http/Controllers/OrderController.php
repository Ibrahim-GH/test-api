<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Store;
use App\Models\User;
use App\Notifications\SendToAdminNotification;
use App\Notifications\SendToUserNotification;
use Illuminate\Support\Facades\Notification;


class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Order::class, 'order');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        //get retrieve orders records
        $orders = Order::paginate(10);
        foreach ($orders as $order) {
            if ($order->user_id == auth()->id()) {
                $array[] = $order;
            }
        }

        return OrderResource::collection($array);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CreateOrderRequest $request
     * @return OrderResource
     */
    public function store(CreateOrderRequest $request)
    {
        $order = new Order();
        $order->order_number = $request->orderNumber;
        $order->item_count = $request->itemCount;
        $order->status = $request->status;
        $order->note = $request->note;
        $order->user_id = auth()->id();

        $id = $request->storeId;
        $store = Store::find($id);
        $adminId = $store->user->id;
        if (auth()->id() !== $adminId) {

            if ($order->save()) {

                foreach ($request->products as $item) {
                    $orderproduct = new OrderProduct();
                    $orderproduct->order_id = $order->id;
                    $orderproduct->product_id = $item['productId'];
                    $orderproduct->price = $item['price'];
                    $orderproduct->quantity = $item['quantity'];

                    $orderproduct->save();
                }

                $admin = User::find($adminId);
                Notification::send($admin, new SendToAdminNotification($order));

                return new OrderResource($order);
            }

        } else {
            abort(400, 'the store owner can not create order from his store');
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
        $order->status = $request->status;

        $id = $request->storeId;
        $store = Store::find($id);
        $adminId = $store->user->id;
        if (auth()->id() == $adminId) {

            if ($order->save()) {

                $userId = $order->user_id;
                $user = User::find($userId);
                Notification::send($user, new SendToUserNotification($order));

                return new OrderResource($order);
            }
        } else {
            abort(400, ' auth user must be the store owner ');
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
        $id = $order->store_id;
        $sId = Store::find($id);
        $admin = $sId->user->id;
        if (auth()->id() == $admin) {

            if ($order->delete()) {
                return new OrderResource($order);
            }

        } else {
            abort(400, 'the user can not delete this order');
        }
    }


    public function restore(Order $order)
    {
        $id = $order->store_id;
        $store = Store::find($id);
        $admin = $store->user->id;
        if (auth()->id() == $admin) {

            $order->restore();
            return new OrderResource($order);

        } else {
            abort(400, 'the user can not delete order');
        }
    }

}
