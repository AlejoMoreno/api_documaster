<?php 

namespace App\Console;


class StringConvert{
    /**
     * Reemplaza cadenas en un texto utilizando patrones y reemplazos.
     *
     * @param string $text El texto de entrada.
     * @param array $search Un array de patrones a buscar.
     * @param array $replace Un array de cadenas de reemplazo correspondientes.
     * @return string El texto modificado.
     */
    public static function replaceStrings($text, $search, $replace)
    {
        return str_replace($search, $replace, $text);
    }
}