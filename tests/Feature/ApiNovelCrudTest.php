<?php

namespace Tests\Feature;

use App\Models\Novel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiNovelCrudTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_novels()
    {
        // Arrange: Create some novels
        Novel::factory()->count(3)->create();

        // Act: Send a GET request to the API endpoint
        $response = $this->getJson('/api/novels');

        // Assert: Check that the response contains the novels
        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');
    }

    /** @test */
    public function it_can_create_a_novel_via_api()
    {
        // Arrange: Novel data
        $novelData = [
            'title' => 'Test Novel',
            'author' => 'Test Author',
            'synopsis' => 'This is a test synopsis',
            'published_at' => now(),
        ];

        // Act: Send a POST request to the API
        $response = $this->postJson('/api/novels', $novelData);

        // Assert: Check that the novel was created
        $response->assertStatus(201);
        $this->assertDatabaseHas('novels', ['title' => 'Test Novel']);
    }

    /** @test */
    public function it_can_update_a_novel_via_api()
    {
        // Arrange: Create a novel
        $novel = Novel::factory()->create();

        // Act: Send a PUT request to update the novel
        $response = $this->putJson("/api/novels/{$novel->id}", [
            'title' => 'Updated Title',
            'author' => 'Updated Author',
            'synopsis' => 'Updated Synopsis',
            'published_at' => now(),
        ]);

        // Assert: Check that the novel was updated
        $response->assertStatus(200);
        $this->assertDatabaseHas('novels', ['title' => 'Updated Title']);
    }

    /** @test */
    public function it_can_delete_a_novel_via_api()
    {
        // Arrange: Create a novel
        $novel = Novel::factory()->create();

        // Act: Send a DELETE request
        $response = $this->deleteJson("/api/novels/{$novel->id}");

        // Assert: Check that the novel was deleted
        $response->assertStatus(204);
        $this->assertDatabaseMissing('novels', ['id' => $novel->id]);
    }

    /** @test */
    public function it_can_show_a_novel_via_api()
    {
        // Arrange: Create a novel
        $novel = Novel::factory()->create();

        // Act: Send a GET request to view the novel
        $response = $this->getJson("/api/novels/{$novel->id}");

        // Assert: Check that the response contains the novel data
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'id' => $novel->id,
                'title' => $novel->title,
            ],
        ]);
    }
}
