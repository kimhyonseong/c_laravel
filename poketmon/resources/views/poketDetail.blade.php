@extends('layouts.frame')

@section('pokeList')
    <div class="pokeList">
        <div class="pokeListInner">
            <a href="/pokedex/{{$pokeList['pre']['num_int']}}">
                {{$pokeList['pre']['num_str'].' '.$pokeList['pre']['name']}}
            </a>
        </div>
        <div class="pokeListInner">
            <a href="/pokedex/{{$pokeList['next']['num_int']}}" class="right">
                {{$pokeList['next']['num_str'].' '.$pokeList['next']['name']}}
            </a>
        </div>
    </div>
@endsection

@section('pokeInfo')
    <div class="pokeInfo">
        <div class="img">
            <img src="https://via.placeholder.com/350" alt="{{$poke[0]['name']}}" style="width: 350px;">
        </div>
        <div class="info">
            <h3>
                <p class="num">{{$poke[0]['num_str']}}</p>
                {{$poke[0]['name']}}
            </h3>
            <p>타입 : {!!$poke[0]['types']!!}</p>
            <p>키 : {{$poke[0]['height']}}</p>
            <p>몸무게 : {{$poke[0]['weight']}}</p>
        </div>
    </div>
@endsection

@section('evolution')
    @if(!empty($evolution[0]['num_int']))
    <div class="evolution">
        <h3>진화</h3>
        <div class="evolutionList">
            @for($i = 0; $i < count($evolution); $i++)
                <div class="evolutionContent">
                    <a href="/pokedex/{{$evolution[$i]['num_int']}}">
                        <div class="pokeImg">
                            <img src="https://via.placeholder.com/120" alt="{{$evolution[$i]['name']}}">
                        </div>
                        <div class="info">
                            {{$evolution[$i]['num_str']}}
                            {{$evolution[$i]['name']}}
                        </div>
                    </a>
                </div>
            @endfor
        </div>
    </div>
    @endif
@endsection

@section('content')
    <div class="contain">
        @yield('pokeList')
        @yield('pokeInfo')
        @yield('evolution')
    </div>
@endsection

@section('css')
    .right {
    text-align: right;
    justify-content: right;
    margin-right: 0 !important;
    margin-left: 7px;
    }
    .contain {
    width: 100%;
    margin: auto;
    /*box-shadow : 0 0 0 1px #000 inset;*/
    }
    .contain .pokeInfo::before {
    position: absolute;
    content: '';
    top: -30px;
    height: 40px;
    width: 100%;
    background-color: white;
    border: 1px solid black;
    border-bottom: 0;
    border-radius: 20px 20px 0 0;
    }
    .contain .pokeInfo {
    position: relative;
    top: 10px;
    width: 70%;
    height: 400px;
    margin: 10px auto auto auto;
    border: 1px solid black;
    border-radius: 0 0 20px 20px;
    /*box-shadow : 0 0 0 1px #000 inset;*/
    display: flex;
    justify-content: center;
    }
    .contain .pokeInfo .img {
    width: 50%;
    height: 400px;
    margin: auto;
    /*box-shadow : 0 0 0 1px #000 inset;*/
    display: flex;
    justify-content: center;
    align-items: center;
    }
    .contain .pokeInfo .info {
    width: 50%;
    margin: auto;
    padding: 10%;
    box-sizing: border-box;
    /*box-shadow : 0 0 0 1px #000 inset;*/
    }
    .contain .pokeInfo .info .num{
    color: #6b7280;
    font-size: 25px;
    }
    .contain .pokeList {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;

    }
    .contain .pokeList .pokeListInner {
    flex: 1 1 50%;
    min-height: 50px;
    display: flex;
    align-items: center;
    }
    .contain .pokeList .pokeListInner a{
    background-color: #393939;
    color: #cbd5e0;
    width: 100%;
    height: 100%;
    padding: 0 10px;
    display: flex;
    align-items: center;
    margin-right: 7px;
    transition: 0.5s;
    }
    .contain .pokeList .pokeListInner a:hover {
    background-color: #2d3748;
    transition: 0.5s;
    }
    .contain .evolution{
    width: 70%;
    margin: 35px auto auto auto;
    }
    .contain .evolution .evolutionList{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-evenly;
    }
    .contain .evolution .evolutionList .evolutionContent {
    display: flex;
    align-items: center;
    }
    .contain .evolution .evolutionList .evolutionContent::before{
    content: '';
    transform: rotate(45deg);
    border-top: #B5B5BBFF 5px solid;
    border-right: #B5B5BBFF 5px solid;
    display: inline-block;
    width: 30px;
    height: 30px;
    margin-right: 40px;
    }
    .contain .evolution .evolutionList .evolutionContent:first-child::before{
    content: '';
    width: 0;
    height: 0;
    border-top: 0;
    border-right: 0;
    }
    h3 {
    font-size: 40px;
    }
    .type {
    color: white;
    padding: 2px 5px 2px 5px;
    border-radius: 6px;
    }
@endsection
