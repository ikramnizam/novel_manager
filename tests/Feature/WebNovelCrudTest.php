<?php

namespace Tests\Feature;

use App\Models\Novel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebNovelCrudTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_the_novels_list()
    {
        // Arrange: Create some novels
        Novel::factory()->count(3)->create();

        // Act: Send a GET request to the novels index route
        $response = $this->get(route('novels.index'));

        // Assert: Check that the response contains the novels
        $response->assertStatus(200);
        $response->assertViewHas('novels');
    }

    /** @test */
    public function it_can_create_a_novel()
    {
        // Arrange: Novel data
        $novelData = [
            'title' => 'Test Novel',
            'author' => 'Test Author',
            'synopsis' => 'This is a test synopsis',
            'published_at' => now(),
        ];

        // Act: Send a POST request to store the novel
        $response = $this->post(route('novels.store'), $novelData);

        // Assert: Check that the novel was created and we were redirected
        $response->assertRedirect(route('novels.index'));
        $this->assertDatabaseHas('novels', ['title' => 'Test Novel']);
    }

    /** @test */
    public function it_can_update_a_novel()
    {
        // Arrange: Create a novel
        $novel = Novel::factory()->create();

        // Act: Send a PUT request to update the novel
        $response = $this->put(route('novels.update', $novel->id), [
            'title' => 'Updated Title',
            'author' => 'Updated Author',
            'synopsis' => 'Updated Synopsis',
            'published_at' => now(),
        ]);

        // Assert: Check that the novel was updated
        $response->assertRedirect(route('novels.index'));
        $this->assertDatabaseHas('novels', ['title' => 'Updated Title']);
    }

    /** @test */
    public function it_can_delete_a_novel()
    {
        // Arrange: Create a novel
        $novel = Novel::factory()->create();

        // Act: Send a DELETE request to remove the novel
        $response = $this->delete(route('novels.destroy', $novel->id));

        // Assert: Check that the novel was deleted
        $response->assertRedirect(route('novels.index'));
        $this->assertDatabaseMissing('novels', ['id' => $novel->id]);
    }

    /** @test */
    public function it_can_show_a_novel()
    {
        // Arrange: Create a novel
        $novel = Novel::factory()->create();

        // Act: Send a GET request to show the novel details
        $response = $this->get(route('novels.show', $novel->id));

        // Assert: Check that the response contains the novel details
        $response->assertStatus(200);
        $response->assertViewHas('novel', $novel);
    }
}
