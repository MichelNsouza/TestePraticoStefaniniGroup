<?php

namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

final class StatusTarefa extends Enum
{
    const NAO_INICIADO = 'não iniciado';
    const EM_ANDAMENTO = 'em andamento';
    const CONCLUIDO = 'concluído';


    public static function values(): array
    {
        return [
            self::NAO_INICIADO,
            self::EM_ANDAMENTO,
            self::CONCLUIDO,
        ];
    }


    public static function labels(): array
    {
        return [
            'não iniciado' => 'Não Iniciado',
            'em andamento' => 'Em Andamento',
            'concluído' => 'Concluído',
        ];
    }
}
