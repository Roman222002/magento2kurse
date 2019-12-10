<?php
class Calkulator implements interfaceCalculator
{

    function dodv($ar1, $ar2)
    {
        return $ar1+$ar2;
    }

    function vidn($ar1, $ar2)
    {
        return $ar1-$ar2;
    }

    function mnoch($ar1, $ar2)
    {
        return $ar1*$ar2;
    }

    function dilen($ar1, $ar2)
    {
        return $ar1/$ar2;
    }
}