@extends('master')

@section('content')
    <p>
        {{$greeting}} {{$name}}. welcome
{{--         $greeting //주석처리--}}
    </p>
    <ul>
        @foreach($items as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>
@stop

@section('script')
    <script>
        alert("Hello Blade~ ^^/");
    </script>
@stop