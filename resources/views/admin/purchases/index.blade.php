@extends('layouts.master')
@section('title', 'Purchases')

@section('content')

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#purchases').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.purchases.data') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone' },
                    { data: 'address', name: 'address' },
                    { data: 'total', name: 'total' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action' }
                ]
            });
        });
    </script>
@endsection
