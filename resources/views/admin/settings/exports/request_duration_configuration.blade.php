<table>
    <thead>
    <tr>
        <th>Request Type</th>
        <th>Operator</th>
        <th>Operation Area</th>
        <th>Processing Days</th>
        <th>Active</th>
    </tr>
    </thead>
    <tbody>
    @foreach($requestDurations as $requestDuration)
        <tr>
            <td>{{$requestDuration->requestType->name?? ''}}</td>
            <td>{{$requestDuration->operator->name?? ''}}</td>
            <td>{{$requestDuration->operationArea->name?? ''}}</td>
            <td>{{$requestDuration->processing_days}}</td>
            @if($requestDuration->is_active == 1)
                <td>Yes</td>
            @else
                <td>No</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
