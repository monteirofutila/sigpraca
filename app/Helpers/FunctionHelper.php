<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Storage;

class FunctionHelper
{
    static function uploadPhoto($file, $namePath): string
    {
        // Verifica se um arquivo foi enviado
        if (!$file) {
            throw new Exception("Nenhum arquivo enviado.");
        }

        // Gera um novo nome para o arquivo, concatenando o ID do usuário com o nome original
        //$filename = $ID . '-' . $file->getClientOriginalExtension();

        // Armazenamento de arquivo usando a função store() do Laravel
        //$path = $file->storeAs($namePath, $filename);

        // Retorna o caminho completo do arquivo salvo.
        return $file->store($namePath);
    }

    static function deletePhoto($path): void
    {
        Storage::delete($path);
    }

    static function generateCodeNumber(string $prefix = null): string
    {
        $microtime = microtime(); // Obter o timestamp atual
        $microtime = str_replace([' ', '.'], '', $microtime);

        if ($prefix) {
            $microtime = substr($microtime, 1, 6);
        } else {
            $microtime = substr($microtime, 0, 9);
        }

        return $prefix . $microtime;
    }
}