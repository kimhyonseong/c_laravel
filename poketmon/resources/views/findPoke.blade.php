@extends('layouts.frame')

@section('css')
    main {
    display: flex;
    justify-content: center;
    }
    .forest {
    margin-top: 25px;
    width: 90%;
    display: flex;
    flex-direction: column;
    }
    .forest .flower_bed {
    display: flex;
    justify-content: center;
    float: left;
    }
    .forest .flower_bed .grass_row{
    width: 15%;
    }
    .forest .grass {
    width: 100%;
    height: 100%;
    cursor: pointer;
    }
    .curtain {
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.7);
    top: 0;
    display: none;
    }
    .curtain .info_box{
    position: absolute;
    width: 720px;
    /*width: 70%;*/
    /*height: 70%;*/
    /*border: 1px blue solid;*/
    border-radius: 25px;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    background-color: white;
    }
    .curtain .info_box .info_box_inner{
    width: 100%;
    height: 100%;
    padding: 20px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    }
    .curtain .info_box .info_box_inner .menu {
    width: 100%;
    height: auto;
    }
    .curtain .info_box .info_box_inner .menu .close{
    float: right;
    border-radius: 30px;
    width: 30px;
    height: 30px;
    background-color: #d3d3d3;
    border: none;
    cursor: pointer;
    font-size: 15px;
    }
    .curtain .info_box .info_box_inner .info {
    width: 100%;
    height: auto;
    display: flex;
    }
    .curtain .info_box .info_box_inner .info .img_box,.text_box{
    width: 50%;
    height: auto;
    box-sizing: border-box;
    padding: 15px;
    }
    .curtain .info_box .info_box_inner .info .text_box{
    padding-left: 40px;
    }
    .curtain .info_box .info_box_inner .info .img_box #img,.text{
    width: 100%;
    }
    .curtain .info_box .info_box_inner .info .text_box .text .num{
    color: #6b7280;
    font-size: 25px;
    }
    .curtain .info_box .info_box_inner .info .text_box .text .name{
    font-size: 40px;
    }
    .curtain .info_box .info_box_inner .info .text_box .text .types{
    height: 30px;
    }
    .curtain .info_box .info_box_inner .info .text_box .text .types .type{
    border-radius: 7px;
    padding: 4px;
    margin-right: 5px;
    display: inline-block;
    text-align: center;
    min-width: 30px;
    }
@endsection

@section('content')
    <div class="forest">
        @for($j=0; $j<4; $j++)
            <ul class="flower_bed">
                @for($i=0; $i<5; $i++)
                    <li class="grass_row">
                        <img class="grass" src="{{asset('image/green2.png')}}" alt="풀숲">
                    </li>
                @endfor
            </ul>
        @endfor
    </div>
    <div class="curtain">
        <div class="info_box">
            <div class="info_box_inner">
                <div class="menu">
                    <button class="close">X</button>
                </div>
                <div class="info">
                    <div class="img_box">
                        <img id="img" src="https://via.placeholder.com/250"
                             onerror="this.src='https://via.placeholder.com/250'" alt="">
                    </div>
                    <div class="text_box">
                        <div class="text">
                            <h3><span class="num">No.000</span></h3>
                            <h3><span class="name">이름</span></h3>
                            <p class="types"></p>
                            <p class="gender"></p>
                            <p class="weight">0.0 kg</p>
                            <p class="height">0.0 m</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let grass = document.getElementsByClassName('grass');
        let curtain = document.getElementsByClassName('curtain').item(0);

        let info_box = document.getElementsByClassName('info_box').item(0);
        let info_box_inner = info_box.getElementsByClassName('info_box_inner').item(0);
        let close_bt = info_box_inner.querySelector('.close');
        let info = info_box_inner.getElementsByClassName('info').item(0);
        let poke_img = document.getElementById('img');

        let text_box = info.getElementsByClassName('text_box').item(0);
        let text = text_box.getElementsByClassName('text').item(0);
        let num = text.querySelector('.num');
        let name = text.querySelector('.name');
        let types = text.getElementsByClassName('types').item(0);
        let gender = text.getElementsByClassName('gender').item(0);
        let weight = text.getElementsByClassName('weight').item(0);
        let height = text.getElementsByClassName('height').item(0);

        function shakeGrass(element) {
            if (!element.classList.contains('found')) {
                element.src = element.src === '{{asset('image/green2.png')}}' ? '{{asset('image/green1.png')}}' : '{{asset('image/green2.png')}}';
            }
        }

        function findPoke() {
            let xml = new XMLHttpRequest();

            xml.onreadystatechange = function () {
                if (this.status === 200 && this.readyState === this.DONE) {
                    let info = JSON.parse(xml.response);
                    console.log(info);

                    poke_img.src = info.pokemon.img;
                    num.innerText = 'No.'+info.pokemon.num.toString().padStart(3,'0');
                    name.innerText = info.pokemon.name;
                    types.innerHTML = info.pokemon.types;
                    gender.innerHTML = info.pokemon.gender.toString().localeCompare('0') === 0 ? '남 ♂' : '여 ♀';
                    height.innerText = info.pokemon.height+'m';
                    weight.innerText = info.pokemon.weight+'kg';

                    curtain.style.display = 'block';
                }
            }
            xml.open('GET','/findPokeAjax',true);
            xml.send();
        }

        window.addEventListener('DOMContentLoaded', function () {
            Array.from(grass).forEach(function (element) {
                element.addEventListener('mouseover', () => shakeGrass(element));
                element.addEventListener('mouseout', () => shakeGrass(element));
                element.addEventListener('click', function () {
                    if (!this.classList.contains('found')) {
                        findPoke();
                        this.classList.add('found');
                    }
                });
            })

            close_bt.addEventListener('click',function () {
                curtain.style.display = 'none';
            })
        })
    </script>
@endsection
