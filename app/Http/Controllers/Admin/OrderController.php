<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\OrderDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Admin\UpdateOrderRequest;
use App\Models\Order;
use App\Repositories\Admin\OrderRepository;
use Illuminate\Http\Request;
use Response;

class OrderController extends AppBaseController
{
    /** @var OrderRepository */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
    }

    /**
     * Display a listing of the Order.
     *
     * @param OrderDataTable $orderDataTable
     * @return Response
     */
    public function index(OrderDataTable $orderDataTable)
    {
        return $orderDataTable->render('admin.orders.index');
    }

    /**
     * Display the specified Order.
     *
     * @param Order $order
     * @return Response
     */
    public function show(Order $order)
    {
        $order->load(['orderItems.product', 'user']);
        return view('admin.orders.show')->with('order', $order);
    }

    /**
     * Update the specified Order in storage.
     *
     * @param Order $order
     * @param UpdateOrderRequest $request
     *
     * @return Response
     */
    public function update(Order $order, UpdateOrderRequest $request)
    {
        $input = OrderRepository::requestHandler($request);

        $this->orderRepository->update($input, $order->id);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Order updated successfully.');

        return Response::json(['message' => 'Order status has been updated successfully.',
            'back_url' => route('admin.orders.index')]);
    }

    /**
     * Remove the specified Order from storage.
     *
     * @param Order $order
     * @return Response
     */
    public function destroy(Order $order)
    {
        $this->orderRepository->delete($order->id);

        return Response::json(['message' => 'Order deleted successfully']);
    }

    /**
     * Custom status update for Order
     */
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return response()->json(['message' => 'Order status updated successfully']);
    }
}
