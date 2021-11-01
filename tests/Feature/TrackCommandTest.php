<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use App\Notifications\ImportantStockUpdate;
use Database\Seeders\RetailerWithProductSeeder;
use Facades\App\Clients\ClientFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Notification;
use Tests\TestCase;

class TrackCommandTest extends TestCase
{

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RetailerWithProductSeeder::class);
        Notification::fake();
    }


    /** @test */
    function it_tracks_product_stock()
    {
        $this->assertFalse(Product::first()->inStock());
        $this->mockClientRequest(true, 29900);

        $this->artisan('track')->expectsOutput("All Done");
        $this->assertTrue(Product::first()->inStock());
    }

    /** @test */
    function it_notifies_the_user_when_the_stock_is_now_available()
    {
        $this->mockClientRequest();
        $this->artisan('track');
        Notification::assertSentTo(User::first(), ImportantStockUpdate::class);
    }

    /** @test */
    function it_does_not_notifies_the_user_when_the_stock_remains_unavailable()
    {
        $this->mockClientRequest();
        $this->artisan('track');
        Notification::assertNothingSent();
    }

}
