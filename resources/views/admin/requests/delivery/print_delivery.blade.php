@extends('layouts.print')
@section('title',"Delivery Note -" .$request->customer->name)

@section('content')
    <div class="container my-5 position-relative">

        <div class="d-flex justify-content-between">
            <div>
                <img src="{{ asset('img/logo.svg') }}" style="height: 70px;" alt="" class="border py-2 mb-2"/>
                <div class="font-weight-bolder">
                    Customer
                </div>
                <table class="table-borderless">
                    <tbody>
                    <tr>
                        <td class="py-1">Name:</td>
                        <td class="py-1">{{ $request->customer->name }}</td>
                    </tr>
                    <tr>
                        <td class="py-1">Address:</td>
                        <td class="py-1">{{ $request->customer->address??'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="py-1">Phone:</td>
                        <td class="py-1"> {{ $request->customer->phone??'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="py-1">Email:</td>
                        <td class="py-1">{{ $request->customer->email??'N/A' }}</td>
                    </tr>
                    </tbody>
                </table>

            </div>
            <div>
                <button class="btn btn-success  d-print-none px-4 mb-3" type="button" onclick="window.print();">
                  <span class="svg-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24"
                             height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path
                            d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                        <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
                    </svg>
                  </span>
                    Print
                </button>
                <h1 class="text-primary fw-bold text-end">
                    Delivery Note
                </h1>

            </div>

        </div>
        <div class="my-3">
            <div class="font-weight-bolder">
                Delivery Items:
            </div>
            <div>
                <table class="table table-head-custom table-head-solid border">
                    <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($request->items as $item)
                        <tr>
                            <td>{{ $item->item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->unit_price) }}</td>
                            <td>{{  number_format($item->total ) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3" class="text-end font-weight-bolder">Total:</td>
                        <td class="font-weight-bold">{{ number_format($request->items->sum('total')) }}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <p class="small mb-0">
            Thank you for your business.
        </p>
        {{--   <p class="small">
               Please check all items carefully before signing this delivery note.
           </p>--}}

        {{--       <div class="mt-3">
                   <p>
                       Signature: <span style="width: 200px; display: inline-block;border-bottom:2px dashed ">&nbsp;</span>
                   </p>
               </div>--}}

    </div>

@endsection
