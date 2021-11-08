@extends('layouts.frame')

@section('content')
    <ul id="poketmonList">
        <li>
            <div class="li_wrap">
                <div class="img">
                    <div class="thumb">
                        <img src="https://via.placeholder.com/120" alt="임시 이미지">
                    </div>
                </div>
                <div class="info">
                    <div class="num">No. 000</div>
                    <div class="name">김현성</div>
                </div>
            </div>
        </li>
    </ul>
@endsection

@section('script')
    <script>
        let page = 0;
        let ajaxStop = true;
        let poketmonList = document.getElementById('poketmonList');

        window.addEventListener("DOMContentLoaded", function () {
            // 최초 함수 실행
            showPoketmon(page);
        })

        window.addEventListener('load', function () {
            // if (poketmonList.clientHeight < document.body.clientHeight) {
            //     ++page;
            //     showPoketmon(page);
            // }
        })

        window.addEventListener('scroll', function () {
            let list = poketmonList.children;
            let lastLiOffset = list.item(list.length-1).offsetTop;
            let windowOffset = Math.ceil(window.pageYOffset + window.innerHeight);

            // 스크롤시 함수 실행
            if (ajaxStop && (lastLiOffset < windowOffset)) {
                page++;
                showPoketmon(page);
            }
        })

        function showPoketmon(pages) {
            ajaxStop = false;
            let ajax = new XMLHttpRequest();
            let url = "/poketAjax/" + pages;
            let ul = document.getElementById("poketmonList");
            let html = ``;

            ajax.open("GET", url);
            ajax.onreadystatechange = function () {

                if (ajax.readyState === XMLHttpRequest.DONE) {
                    if (ajax.status === 0 || (ajax.status >= 200 && ajax.status < 400)) {
                        let poketmons = JSON.parse(ajax.responseText);

                        for (let i = 0; i < poketmons.result.length; i++) {
                            html += poketmons.result[i].html;
                        }
                        ul.innerHTML += html;

                        ajaxStop = poketmons.result.length > 0;

                        if (poketmonList.clientHeight < window.innerHeight) {
                            ++page;
                            showPoketmon(page);
                        }
                    }
                }
            }
            ajax.send();
        }
    </script>
@endsection

@section('css')
    #poketmonList {
    display: flex;
    flex-wrap: wrap;
    /*justify-content: center;*/
    }
    #poketmonList li {
    width: 150px;
    height: 180px;
    box-shadow: 3px 3px 7px gray;
    border-radius: 10px;
    margin: 20px;
    transition: all 300ms ease-in-out;
    }
    #poketmonList li:hover {
    transform: scale(1.1);
    transition: all 300ms ease-in-out;
    }
    #poketmonList li .li_wrap {
    box-sizing: border-box; padding: 10px; width: 100%; height: 100%;
    }
    #poketmonList li .li_wrap .img {
    width: 100%; height: 75%; display: flex; justify-content: center;
    }
    #poketmonList li .li_wrap .info {
    width: 100%;
    }
    #poketmonList li .li_wrap .info .num{
    font-size: small;
    color: rgba(0,0,0,0.6);
    margin: 1px 0;
    }
@endsection
