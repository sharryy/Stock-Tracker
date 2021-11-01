<?php

namespace Tests\Feature;

use App\Clients\StockStatus;
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

    /** @test */
    function it_tracks_product_stock()
    {
        $this->seed(RetailerWithProductSeeder::class);

        /*
         * Only for Unit Testing
         */

        $this->assertFalse(Product::first()->inStock());
        ClientFactory::shouldReceive('make->checkAvailability')->andReturn(new StockStatus($available = true, $price = 29900));

        $this->artisan('track')->expectsOutput("All Done");
        $this->assertTrue(Product::first()->inStock());
    }

    /** @test */
    function it_notifies_the_user_when_the_stock_changes_in_a_notable_way()
    {
        Notification::fake();
        $user = User::factory()->create(['email' => 'sharryy@gmail.com']);
        $this->seed(RetailerWithProductSeeder::class);
        ClientFactory::shouldReceive('make->checkAvailability')->andReturn(new StockStatus($available = true, $price = 29900));
        $this->artisan('track');
        Notification::assertSentTo($user, ImportantStockUpdate::class);

    }

}
