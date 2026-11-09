@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header & Back Button -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-medium text-slate-900">Transaction Detail</h1>
        <a href="{{ route('transactions.index') }}"
            class="inline-flex items-center gap-1.5 border border-slate-800 rounded-[5px] text-xs font-medium text-slate-800 px-4 py-2 hover:bg-slate-100 transition-colors">
            Back to Transactions
        </a>
    </div>

    <!-- Summary Card -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-base font-bold text-slate-800">Invoice {{ $transaction->receipt_number }}</h3>
            @if(strtolower($transaction->payment_status) === 'paid')
                <span class="inline-block px-3 py-1 rounded-md text-[11px] font-semibold border-2 border-[#16A34A] text-slate-900 bg-white">Paid</span>
            @else
                <span class="inline-block px-3 py-1 rounded-md text-[11px] font-semibold border-2 border-[#DC2626] text-slate-900 bg-white">Not Paid</span>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-4 text-xs text-slate-700">
            <div class="flex justify-between border-b border-slate-100 pb-2">
                <span class="font-semibold text-slate-500">Customer</span>
                <span class="font-medium text-slate-900">{{ $transaction->customer_name ?? '-' }}</span>
            </div>
            <div class="flex justify-between border-b border-slate-100 pb-2">
                <span class="font-semibold text-slate-500">Admin</span>
                <span class="font-medium text-slate-900">{{ $transaction->admin->name ?? '-' }}</span>
            </div>
            <div class="flex justify-between border-b border-slate-100 pb-2">
                <span class="font-semibold text-slate-500">Sale Type</span>
                <span class="font-medium text-slate-900">{{ $transaction->sale_type }}</span>
            </div>
            <div class="flex justify-between border-b border-slate-100 pb-2">
                <span class="font-semibold text-slate-500">Payment Method</span>
                <span class="font-medium text-slate-900">{{ $transaction->payment_method }}</span>
            </div>
            <div class="flex justify-between border-b border-slate-100 pb-2 md:col-span-2">
                <span class="font-semibold text-slate-500">Shipping Address</span>
                <span class="font-medium text-slate-900 text-right">{{ $transaction->shipping_address ?? '-' }}</span>
            </div>
        </div>
    </div>

    <!-- Items Card -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
        <h3 class="text-base font-bold text-slate-800 mb-4">Items</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-100 text-slate-700 text-xs font-semibold">
                        <th class="py-3 px-4 rounded-l-lg">Product Code</th>
                        <th class="py-3 px-4">Product Name</th>
                        <th class="py-3 px-4">Quantity</th>
                        <th class="py-3 px-4">Unit Price</th>
                        <th class="py-3 px-4 rounded-r-lg">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="text-xs text-slate-700 font-medium divide-y divide-slate-100">
                    @forelse($transaction->items as $item)
                        <tr>
                            <td class="py-3.5 px-4 whitespace-nowrap font-bold text-slate-900">{{ $item->product->product_code ?? '-' }}</td>
                            <td class="py-3.5 px-4 whitespace-nowrap">{{ $item->product->product_name ?? '-' }}</td>
                            <td class="py-3.5 px-4 whitespace-nowrap">{{ $item->quantity }}</td>
                            <td class="py-3.5 px-4 whitespace-nowrap">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                            <td class="py-3.5 px-4 whitespace-nowrap font-semibold text-slate-900">
                                Rp {{ number_format($item->unit_price * $item->quantity, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400">No items in this transaction.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Totals -->
        <div class="flex flex-col items-end gap-2 mt-6 text-xs text-slate-700">
            <div class="flex justify-between w-full max-w-xs">
                <span class="font-semibold text-slate-500">Total Amount</span>
                <span class="font-medium text-slate-900">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between w-full max-w-xs">
                <span class="font-semibold text-slate-500">Shipping Fee</span>
                <span class="font-medium text-slate-900">Rp {{ number_format($transaction->shipping_fee, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between w-full max-w-xs border-t border-slate-200 pt-2">
                <span class="font-bold text-slate-700">Grand Total</span>
                <span class="font-bold text-slate-900">
                    Rp {{ number_format($transaction->total_amount + $transaction->shipping_fee, 0, ',', '.') }}
                </span>
            </div>
        </div>
    </div>
</div>
@endsection
