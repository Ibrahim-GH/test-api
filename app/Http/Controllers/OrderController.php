<?php

namespace App\Http\Controllers;

use App\Enums\PermissionName;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Store;
use App\Notifications\SendToAdminNotification;
use App\Notifications\SendToUserNotification;
use http\Client\Curl\User;
use Illuminate\Support\Facades\Auth;
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
        $query = Order::query();
        $query->where('user_id', Auth::id());

        $perPage = request('perPage', 10);
        $orders = $query->paginate($perPage);

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
        $storeId = $request->storeId;
        $store = Store::find($storeId);

        //the store owner can not buy from his store
        if (auth()->id() !== $store->user_id) {
            $order = new Order();
            $order->order_number = $request->orderNumber;
            $order->item_count = $request->itemCount;
            $order->status = $request->status;
            $order->note = $request->note;
            $order->user_id = auth()->id();

            if ($order->save()) {
                foreach ($request->products as $item) {
                    $orderproduct = new OrderProduct();
                    $orderproduct->order_id = $order->id;
                    $orderproduct->product_id = $item['productId'];
                    $orderproduct->price = $item['price'];
                    $orderproduct->quantity = $item['quantity'];

                    $orderproduct->save();
                }

                Notification::send($store->User, new SendToAdminNotification($order));

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

        $storeid = $request->storeId;
        $store = Store::find($storeid);
        //the store owner do make update on order status
        if (auth()->id() == $store->user_id) {
            if ($order->save()) {
                $user = $order->User;

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
        if (auth()->id() == $order->user_id) {
            if ($order->delete()) {
                return new OrderResource($order);
            }
        } else {
            abort(400, 'the user can not delete this order');
        }
    }


    public function restore(Order $order)
    {
        $user = auth()->user();
        if (($user->id == $order->user_id) ||
            ($user->hasPermissionTo(PermissionName::RESTORE_ORDER))) {

            $order->restore();

            return new OrderResource($order);
        } else {
            abort(400, 'the user can not delete order');
        }
    }

}
