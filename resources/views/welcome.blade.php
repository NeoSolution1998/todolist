@extends('layouts.app')

@section('content')

    <div class="container-sm">
        <main class="container py-2">
            <example-component :count="{{json_encode($count)}}"></example-component>
        </main>
    </div>

    
@endsection
