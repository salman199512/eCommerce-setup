<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\PaymentDataTable;
use App\Http\Controllers\AppBaseController;
use App\Models\Order;
use Illuminate\Http\Request;
use Response;

class PaymentController extends AppBaseController
{
    public function index(PaymentDataTable $paymentDataTable)
    {
        return $paymentDataTable->render('admin.payments.index');
    }

    /**
     * Remove the specified Payment record.
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(['message' => 'Payment record deleted successfully']);
    }
}
