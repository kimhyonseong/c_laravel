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
    <a href="{{ route('LuigiIndex') }}">인덱스</a>
@stop

@section('script')
    <script>
        {{--alert("Hello Blade~ ^^/"); --}}
    </script>
@stop