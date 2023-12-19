<?php 

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGetTransactionHistory()
    {        
        $user = User::factory()->create();
        
        $this->actingAs($user, 'api');

        // Create sample transactions for the user
        $transactions = Transaction::factory()->count(3)->create(['user_id' => $user->id]);

        // Send a GET request to get transaction history
        $response = $this->getJson('/api/v1/transaction-history');

        // Set the response status
        $response->assertStatus(200); 

        // set the response content
        $response->assertJson([
            'transactions' => $transactions->toArray(),            
        ]);
    }
}


?>