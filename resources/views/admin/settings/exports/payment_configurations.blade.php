<table>
    <thead>
    <tr>
        <th>Payment Type</th>
        <th>Request Type</th>
        <th>Operator</th>
        <th>Operation Area</th>
        <th>amount</th>
    </tr>
    </thead>
    <tbody>
    @foreach($paymentConfigurations as $paymentConfiguration)
        <tr>
            <td>{{$paymentConfiguration->paymentType->name?? ''}}</td>
            <td>{{$paymentConfiguration->requestType->name?? ''}}</td>
            <td>{{$paymentConfiguration->operator->name?? ''}}</td>
            <td>{{$paymentConfiguration->operationArea->name?? ''}}</td>
            <td>{{$paymentConfiguration->amount}}</td>
        </tr>w
    @endforeach
    </tbody>
</table>
