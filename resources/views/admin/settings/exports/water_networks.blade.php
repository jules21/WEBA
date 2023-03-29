<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Distance Covered</th>
        <th>Population Covered</th>
        <th>Water Network Type</th>
        <th>Water Network Status</th>
        <th>Operator</th>
        <th>Operation Area</th>
    </tr>
    </thead>
    <tbody>
    @foreach($waterNetworks as $waterNetwork)
        <tr>
            <td>{{$waterNetwork->name}}</td>
            <td>{{$waterNetwork->distance_covered}}</td>
            <td>{{$waterNetwork->population_covered}}</td>
            <td>{{$waterNetwork->waterNetworkType->name?? ''}}</td>
            <td>{{$waterNetwork->waterNetworkStatus->name?? ''}}</td>
            <td>{{$waterNetwork->operator->name?? ''}}</td>
            <td>{{$waterNetwork->operationArea->name?? ''}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
