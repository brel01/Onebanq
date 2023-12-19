<?php 

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testInitiatePayment()
    {        
        $user = User::factory()->create();
        
        $this->actingAs($user, 'api');
        
        $response = $this->postJson('/api/v1/initiate-payment', ['amount' => 2000]);
        
        $response->assertStatus(200); 
        
        $response->assertJson([
            'status' => 'success',            
        ]);
    }
}


?>