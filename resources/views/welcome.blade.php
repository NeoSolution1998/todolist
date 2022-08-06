@extends('layouts.app')

@section('content')

    <div class="container">
        <main class="container py-4">
            <example-component :count="{{json_encode($count)}}"></example-component>
        </main>
    </div>

@endsection
