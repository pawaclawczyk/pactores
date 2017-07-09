<?php

declare(strict_types=1);

namespace Examples\Protocol;

use Pactores\Message;

final class QuoteResponse implements Message
{
    private $quote;

    public function __construct(string $quote)
    {
        $this->quote = $quote;
    }

    public function __toString(): string
    {
        return $this->quote;
    }
}
