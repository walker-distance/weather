<?php


namespace WalkerDistance\Weather\Exceptions;


class InvalidArgumentException extends Exception
{
    //调用方传递的 $format 不是 xml 也不是 json 时需要抛出参数异常
    //调用方传递的 $type 不是 base 也不是 all 时需要抛出参数异常
}