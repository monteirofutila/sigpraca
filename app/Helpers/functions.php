<?php
function uploadPhoto($file, $namePath): string
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

function deletePhoto($path): void
{
    Storage::delete($path);
}