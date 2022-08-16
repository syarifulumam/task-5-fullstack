<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function testCategoryCreate(){
        $user = User::factory()->create();
        Category::factory(5)->create();

        $response = $this->actingAs($user)
                    ->get(route('category.index'));

        $response->assertOk();
        $response->assertSeeText(Category::latest('updated_at')->first()->name);

    }


    public function testAddCategory()
    {
        $user = User::factory()->create();
        $data = ['name' => 'new category'];

        $response = $this->actingAs($user)
                    ->post(route('category.store'), $data);

        $this->assertDatabaseHas('categories', $data);
        $response->assertRedirect(route('category.index'));
    }

    public function testUpdateCategory()
    {
        
        $user = User::factory()->create();
        $oldData = ['name' => 'category'];
        $newData = ['name' => 'new category'];

        $category = Category::factory()->create($oldData);

        $response = $this->actingAs($user)
                    ->put(route('category.update', ['category' => $category]), $newData);

        $this->assertDatabaseMissing('categories', $oldData);
        $this->assertDatabaseHas('categories', $newData);

        $response->assertRedirect(route('category.index'));
    }

    public function testDeleteCategory()
    {
        $this->withExceptionHandling();
        $user = User::factory()->create();
        $data = ['name' => 'category'];
        
        $category = Category::factory()->create($data);
        $response = $this->actingAs($user)
                    ->delete(route('category.destroy', ['category' => $category]));
        $this->assertDatabaseMissing('categories', $category->toArray());
    }

}
