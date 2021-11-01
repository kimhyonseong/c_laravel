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
        @yield('css')
    </style>
</head>
<body>
<div id="wrap">
    @section('header')
    <header>
        <div class="in_header">
            <img src="{{asset('image/poketball.png')}}" style="width: 52px;" alt="메인 이동">
            <div class="right">
                <ul>
                    <li class="on">사전</li>
                    <li>로그인</li>
                    <li>검색</li>
                </ul>
            </div>
        </div>
    </header>
    @show
    <main>
        @yield('content')
    </main>
</div>
</body>
</html>
