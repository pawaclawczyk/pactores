<?php

namespace Pactores\Executor\ThreadPoolExecutor;

use Pactores\Actor\ExampleActor;
use PHPUnit\Framework\TestCase;
use TryDo\Failure;
use TryDo\Success;

class ThreadPoolTest extends TestCase
{
    /** @var ThreadPool */
    private $pool;

    /** @test */
    public function it_fails_creating_worker_for_not_existing_actor()
    {
        $worker = $this->pool->workerFor('SomeActor');

        $this->assertInstanceOf(Failure::class, $worker);
    }

    /** @test */
    public function it_succeeds_creating_worker_for_actor()
    {
        $worker = $this->pool->workerFor(ExampleActor::class);

        $this->assertInstanceOf(Success::class, $worker);
    }

    /** @test */
    public function it_shutdowns_empty()
    {
        $this->assertTrue($this->pool->shutdown());
    }

    /** @test */
    public function it_shutdowns()
    {
        $this->pool->workerFor(ExampleActor::class);

        $this->assertTrue($this->pool->shutdown());
    }

    protected function setUp()
    {
        parent::setUp();

        $this->pool = new ThreadPool();
    }

    protected function tearDown()
    {
        $this->pool->shutdown();
        $this->pool = null;

        parent::tearDown();
    }
}
