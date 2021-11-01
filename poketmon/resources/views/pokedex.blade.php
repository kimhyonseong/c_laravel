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
            width: 100%;
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
            margin-right: 10px;
        }

        a {
            /*text-decoration: none;*/
        }

        a:link {
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
        #poketmonList li {
            width: 150px;
            height: 180px;
            box-shadow: 3px 3px 7px gray;
            border-radius: 10px;
            margin: 20px;
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
    </main>
    <script>
        let page = 0;
        let ajaxStop = true;
        let poketmonList = document.getElementById('poketmonList');

        window.addEventListener("DOMContentLoaded", function () {
            // 최초 함수 실행
            showPoketmon(page);
        })

        window.addEventListener('scroll', function () {
            let list = poketmonList.children;
            let lastLiOffset = list.item(list.length-1).offsetTop;
            let windowOffset = Math.ceil(window.pageYOffset + window.innerHeight);

            // 스크롤시 함수 실행
            if (ajaxStop && (lastLiOffset < windowOffset)) {
                page++;
                console.log(page);
                showPoketmon(page);
            }
        })

        function showPoketmon(page) {
            ajaxStop = false;
            let ajax = new XMLHttpRequest();
            let url = "/poketAjax/" + page;
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
                    }
                }
            }
            ajax.send();
        }
    </script>
</div>
</body>
</html>
