<?php

function typeToNum($str): int
{
    if (trim($str) != '') {
        switch (trim($str)) {
            case '노멀' :
            case '노말' :
                $typeNum = 1;
                break;
            case '불꽃' :
                $typeNum = 2;
                break;
            case '물' :
                $typeNum = 3;
                break;
            case '전기' :
                $typeNum = 4;
                break;
            case '풀' :
                $typeNum = 5;
                break;
            case '얼음' :
                $typeNum = 6;
                break;
            case '격투' :
                $typeNum = 7;
                break;
            case '독' :
                $typeNum = 8;
                break;
            case '땅' :
                $typeNum = 9;
                break;
            case '비행' :
                $typeNum = 10;
                break;
            case '에스퍼' :
                $typeNum = 11;
                break;
            case '벌레' :
                $typeNum = 12;
                break;
            case '바위' :
                $typeNum = 13;
                break;
            case '고스트' :
                $typeNum = 14;
                break;
            case '드래곤' :
                $typeNum = 15;
                break;
            case '악' :
                $typeNum = 16;
                break;
            case '강철' :
                $typeNum = 17;
                break;
            case '페어리' :
                $typeNum = 18;
                break;
            default :
                $typeNum = 0;
                break;
        }
    } else {
        $typeNum = 0;
    }

    return $typeNum;
}
