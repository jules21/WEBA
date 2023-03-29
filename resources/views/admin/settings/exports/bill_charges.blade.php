<table>
    <thead>
    <tr>
        <th>Water Network Type</th>
        <th>Operation Area</th>
        <th>Unit Price</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bill_charges as $bill_charge)
        <tr>
            <td>{{$bill_charge->waterNetworkType->name }}</td>
            <td>{{$bill_charge->operationArea->name ?? ''}}</td>
            <td>{{$bill_charge->unit_price}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
