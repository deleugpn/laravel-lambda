<?php

namespace Tests\Unit;

use App\Components\Bref\FakeLambda;
use App\Components\Queue\LambdaWorkCommand;
use Facades\App\Components\Bref\Bref;
use Tests\TestCase;

class LambdaWorkTest extends TestCase
{
    public function test_queue_lambda_will_work_messages_from_lambda_trigger()
    {
        $this->mockLambdaEvent();

        $this->expectException(MyException::class);

        $this->artisan(LambdaWorkCommand::class, ['--once' => true]);
    }

    private function mockLambdaEvent(): void
    {
        $message = [
            'body' => json_encode([
                'job' => 'Illuminate\Queue\CallQueuedHandler@call',
                'data' => [
                    'command' => serialize(new FakeJob)
                ],
            ]),
            'messageId' => 55,
        ];

        Bref::swap(new FakeLambda(['Records' => [$message]]));
    }
}

class FakeJob
{
    public function handle()
    {
        throw new MyException();
    }
}

class MyException extends \Exception
{

}