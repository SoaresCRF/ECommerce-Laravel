<?php

namespace App\Classes;

class TratamentoString
{
    static public function removerTodosEspacos(String $string): string
    {
        return preg_replace('/\s+/', '', trim($string));
    }

    static public function removerEspacosDuplicados(String $string): string
    {
        return preg_replace('/\s+/', ' ', trim($string));
    }

    static public function extrairNumero(String $string): string
    {
        return preg_replace('/[^0-9]/', "", $string);
    }
}
