<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Tasks extends TestCase
{
   


    /** @test **/
    public function can_store_task()
    {

        $response = $this->json('POST', '/api/task', [
                'title' => 'task1',
        ]);

        $response->assertStatus(201);
      

    }

    /** @test **/
    public function can_update_task()
    {
    

        $data = [
           'title' => 'task13',
        ];
        
        $response = $this->put('/api/task/2', $data);

        $response->assertStatus(200);
        
      

    }

      /** @test **/
    public function test_can_delete_task() {

     
       $response = $this->json('delete', '/api/task/5', []);

        $response->assertStatus(200);
    }


}
