@extends('layouts.main')

@section('title',"New Request")

@section('breadcrumbs')
    <x-layouts.breadcrumb page-title="New Request">

        <x-layouts.breadcrumb-item>
            <a href="" class="text-muted text-decoration-none">
                Requests
            </a>
        </x-layouts.breadcrumb-item>

        <x-layouts.breadcrumb-item>
            New Request
        </x-layouts.breadcrumb-item>

    </x-layouts.breadcrumb>
@endsection


@section('content')
    <div class="card card-body h-100 tw-rounded-lg">
        <h4>
            New Connection
        </h4>
    </div>
@endsection
