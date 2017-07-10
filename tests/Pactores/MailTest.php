<?php

namespace Pactores;

use Pactores\Actor\ActorId;
use PHPUnit\Framework\TestCase;

class MailTest extends TestCase
{
    /** @test */
    public function it_is_equal_with_the_same_content()
    {
        $mail = new Mail("A message", new ActorId(42));
        $sameMail = new Mail("A message", new ActorId(42));

        $this->assertTrue($mail->equals($sameMail));
    }

    /** @test */
    public function it_holds_message()
    {
        $mail = new Mail("A message", new ActorId(42));
        $mailWithDifferentMessage = new Mail("An other message", new ActorId(42));

        $this->assertFalse($mail->equals($mailWithDifferentMessage));
    }

    /** @test */
    public function it_holds_recipient_id()
    {
        $mail = new Mail("A message", new ActorId(42));
        $mailWithDifferentRecipient = new Mail("A message", new ActorId(13));

        $this->assertFalse($mail->equals($mailWithDifferentRecipient));
    }
}
