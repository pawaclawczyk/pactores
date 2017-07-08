<?php

declare(strict_types = 1);

namespace Examples;

final class TeacherProtocol
{
    public static function QuoteRequest()
    {
        return new QuoteRequest();
    }
}
