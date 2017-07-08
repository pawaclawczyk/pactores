<?php

namespace Pactores\Executor\ThreadPoolExecutor;

use Pactores\Actor\ExampleActor;
use Pactores\Actor\ExampleMesssage;
use Pactores\Actor\Mailbox;
use Pactores\Actor\MathDoctor;
use Pactores\Actor\SquareX;
use Pactores\Executor\Executor;
use PHPUnit\Framework\TestCase;

class ThreadPoolExecutorTest extends TestCase
{
    /** @var Executor */
    private $executor;

    /** @test */
    public function it_executes_mailbox_empty_mailbox()
    {
        $mailbox = new Mailbox(new ExampleActor());

        $this->assertNull($this->executor->execute($mailbox));
    }

    /** @test */
    public function it_executes_mailbox()
    {
        $mailbox = new Mailbox(new ExampleActor());
        $mailbox->enqueue(new ExampleMesssage());

        $this->assertNull($this->executor->execute($mailbox));
    }

    /** @test */
    public function it_does_the_real_execution()
    {
        $file = sprintf('/tmp/%s_%s_%s', str_replace('\\', '_', __CLASS__), __FUNCTION__, time());

        if (file_exists($file)) {
            unlink($file);
        }

        $mailbox = new Mailbox(new MathDoctor());
        $mailbox->enqueue(new SquareX($file, 12));

        $this->executor->execute($mailbox);
        $this->executor->shutdown();


        $stream = fopen($file, 'r');
        $result = fread($stream, 1024);

        fclose($stream);

        $this->assertEquals(144, $result);
    }

    /** @test */
    public function it_shutdowns()
    {
        $this->assertTrue($this->executor->shutdown());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->executor = new ThreadPoolExecutor();
    }

    protected function tearDown()
    {
        $this->executor->shutdown();

        $this->executor = null;

        parent::tearDown();
    }
}
