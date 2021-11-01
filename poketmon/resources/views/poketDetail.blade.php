@extends('layouts.frame')

@section('pokeInfo')
    <div class="pokeInfo">
        <div class="img">
            <img src="https://via.placeholder.com/350" alt="{{$poke[0]['name']}}">
        </div>
        <div class="info">
            {{$poke[0]['name']}}
        </div>
    </div>
@endsection

@section('evolution')
    <div class="evolution">

    </div>
@endsection

@section('content')
<div class="contain">
    @yield('pokeInfo')
    @yield('evolution')
</div>
@endsection

@section('css')
    .contain {
    width: 100%;
    margin: auto;
    box-shadow : 0 0 0 1px #000 inset;
    }
    .contain .pokeInfo {
    width: 70%;
    height: 500px;
    margin: auto;
    /*border: 1px black solid;*/
    box-shadow : 0 0 0 1px #000 inset;
    display: flex;
    justify-content: center;
    }
    .contain .pokeInfo .img {
    width: 50%;
    height: 400px;
    margin: auto;
    box-shadow : 0 0 0 1px #000 inset;
    display: flex;
    justify-content: center;
    align-items: center;
    }
    .contain .pokeInfo .info {
    width: 50%;
    height: 400px;
    margin: auto;
    box-shadow : 0 0 0 1px #000 inset;
    }
@endsection
