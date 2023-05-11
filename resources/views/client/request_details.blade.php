@extends('client.layout.auth')
@section('title','Request Details')

@section('breadcrumbs')
    <x-layouts.breadcrumb page-title="Request Details">

        <x-layouts.breadcrumb-item>
            Request Details
        </x-layouts.breadcrumb-item>
    </x-layouts.breadcrumb>
@endsection
@section('content')
    @include('admin.requests.partials._request_details')
@endsection
