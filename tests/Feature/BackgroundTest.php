<?php

namespace Tests\Feature;

use App\Modules\Background\Jobs\BackgroundJob;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class BackgroundTest extends TestCase
{
    public function test_post_queues_will_dispatch_background_job()
    {
        Bus::fake();

        $this->post('/api/background')
            ->assertSuccessful();

        Bus::assertDispatched(BackgroundJob::class);
    }
}
