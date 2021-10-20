<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>도감</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        header {
            background-color: white;
            height: 50px;
            display: flex;
            justify-content: space-between;
            box-shadow: 0 1px 20px 0 rgba(0, 0, 0, 0.4);
            font-size: 30px;
        }
        header .in_header {
            margin: auto;
            width:100%;
            display: flex;
            justify-content: space-between;
        }
        header .right {
            font-size: 20px;
            margin: auto 0;
        }
        header ul {
            list-style: none;
            display: flex;
        }
        header ul li {
            padding: 0 10px;
        }
        main {
            padding-top: 20px;
        }
        main ul {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
        }
        main ul li {
            padding-right: 10px;
        }
        a {
            /*text-decoration: none;*/
        }
        a:link{
            text-decoration: none;
            color: black;
        }
        a:visited {
            text-decoration: none;
            color: black;
        }
        a:hover {
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>
<div id="wrap">
    <header>
        <div class="in_header">
{{--            <img src="{{Storage::url('img/poketball.png')}}" style="width: 52px;" alt="메인 이동">--}}
            <img src="{{asset('image/poketball.png')}}" style="width: 52px;" alt="메인 이동">
            {{--            <strong style="padding: 0 10px">Poket</strong>--}}
            <div class="right">
                <ul>
                    <li class="on">사전</li>
                    <li>로그인</li>
                    <li>검색</li>
                </ul>
            </div>
        </div>
    </header>
    <main>
        <ul id="poketmonList">
{{--            @foreach($poketmons as $poket)--}}
{{--                <li>--}}
{{--                    <a href="javascript:void(0)">--}}
{{--                        <div class="img">--}}
{{--                            <div class="thumb">--}}
{{--                                @if($poket->img != "")--}}
{{--                                    <img src="{{$poket->img}}" alt="{{$poket->name}}">--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            {{$poket->num}}--}}
{{--                            <h3>{{$poket->name}}</h3>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            @endforeach--}}
        </ul>
    </main>
    <script>
        window.addEventListener("DOMContentLoaded", function () {
            showPoketmon(1);
        })

        function showPoketmon(page) {
            let ajax = new XMLHttpRequest();
            let url = "/poketAjax/" + page;
            let ul = document.getElementById("poketmonList");
            let html = ``;

            ajax.open("GET", url);
            ajax.onreadystatechange = function () {

                if (ajax.readyState === XMLHttpRequest.DONE) {
                    if (ajax.status === 0 || (ajax.status >= 200 && ajax.status < 400)) {
                        let poketmons = JSON.parse(ajax.responseText);
                        // console.log(ajax.responseText);
                        // console.log(JSON.parse(ajax.responseText));
                        // console.log(poketmons.result);
                        // console.log(poketmons.result[0]);
                        // console.log(poketmons.result[0].name);
                        for(let i = 0; i < poketmons.result.length; i++) {
                            html += `<li>
                                    <a href="javascript:void(0)">
                                    <div>
                                    ${poketmons.result[i].num}
                                    ${poketmons.result[i].name}
                                    </div>
                                    </a>
                                    </li>`;
                        }
                        ul.innerHTML += html;
                    }
                }
            }
            ajax.send();
        }
    </script>
</div>
</body>
</html>
