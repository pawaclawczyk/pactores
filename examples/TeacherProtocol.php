<?php

declare(strict_types = 1);

namespace Examples;

use Examples\Protocol\InitialSignal;
use Examples\Protocol\QuoteRequest;
use Examples\Protocol\QuoteResponse;

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

    public static function QuoteResponse(string $quote): QuoteResponse
    {
        return new QuoteResponse($quote);
    }
}
