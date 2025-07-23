<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\PreOrder;

class PreOrderController extends Controller
{
    public function index() {
        $preorders = PreOrder::latest()->paginate(20);
        return view('admin.preorders.index', compact('preorders'));
    }

    public function create() {
        return view('admin.preorders.create');
    }

    public function edit($id)
    {
        $preorder = PreOrder::findOrFail($id);
        return view('admin.preorders.edit', compact('preorder'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name'   => 'required|string|max:255',
            'product_details' => 'required|string',
            'email' => 'string',
            'phone' => 'required|numeric',
            'status'          => 'required|in:pending,paid,processing,shipped,completed,canceled',
            'estimated_cost' => 'numeric|min:0'
        ]);

        $preorder = new Preorder();
        $preorder->name = $validated['customer_name'];
        $preorder->product_details = $validated['product_details'];
        $preorder->estimated_cost = $validated['estimated_cost'];
        $preorder->phone = $validated['phone'];
        $preorder->email = $validated['email'];
        $preorder->status = $validated['status'];
        $preorder->invoice_code = strtoupper(uniqid('INV-')); // Or use Str::random()

        $preorder->save();

        return redirect()->route('admin.preorders.index')->with('success', 'Preorder created successfully.');
    }


    public function show($id) {
        $order = PreOrder::findOrFail($id);
        return view('admin.preorders.show', compact('order'));
    }

    public function invoice($id) {
        $order = PreOrder::findOrFail($id);
        return view('admin.preorders.invoice', compact('order'));
    }

    public function updateStatus(Request $request, $id) {
        $order = PreOrder::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Status updated successfully.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'customer_name'   => 'required|string|max:255',
            'product_details' => 'required|string',
            
            'status'          => 'required|in:pending,paid,processing,shipped,completed,canceled',
            'estimated_cost' => 'numeric|min:0'
        ]);

        $order = PreOrder::findOrFail($id);
        $order->update($validated);

        return redirect()->route('admin.preorders.show', $id)->with('success', 'Preorder updated successfully.');
    }

    public function destroy($id)
    {
        $order = PreOrder::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.preorders.index')->with('success', 'Preorder deleted successfully.');
    }

}
