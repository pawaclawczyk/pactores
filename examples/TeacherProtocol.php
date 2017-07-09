<?php

declare(strict_types = 1);

namespace Examples;

use Examples\Protocol\InitialSignal;

final class TeacherProtocol
{
    public static function InitialSignal(): InitialSignal
    {
        return new InitialSignal();
    }

    public static function QuoteRequest(): QuoteRequest
    {
        return new QuoteRequest();
    }
}
