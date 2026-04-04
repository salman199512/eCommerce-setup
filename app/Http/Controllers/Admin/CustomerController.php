<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\CustomerDataTable;
use App\Models\User;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Response;

class CustomerController extends AppBaseController
{
    public function index(CustomerDataTable $customerDataTable)
    {
        return $customerDataTable->render('admin.customers.index');
    }

    public function show($id)
    {
        $customer = User::role('customer')->with(['orders' => function($query) {
            $query->orderBy('created_at', 'desc');
        }])->findOrFail($id);

        return view('admin.customers.show', compact('customer'));
    }

    public function destroy($id)
    {
        $customer = User::role('customer')->findOrFail($id);
        $customer->delete();

        return Response::json(['message' => 'Customer deleted successfully']);
    }
}
