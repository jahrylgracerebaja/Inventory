<?php

namespace Tests\Feature;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_items_page_shows_an_empty_state_and_created_items(): void
    {
        $this->get(route('items.index'))
            ->assertOk()
            ->assertSee('No items yet')
            ->assertSee('Jahryl Grace Rebaja')
            ->assertSee('Created by')
            ->assertSee('id="creator"', false)
            ->assertSee('id="items"', false)
            ->assertSee('images/jahryl-grace-rebaja.jpg', false)
            ->assertSee(route('items.index').'#creator', false)
            ->assertSee(route('items.index').'#items', false);

        $item = Item::create([
            'name' => 'Desk lamp',
            'description' => 'Brass reading lamp',
            'quantity' => 4,
            'price' => '29.95',
        ]);

        $this->get(route('items.index'))
            ->assertOk()
            ->assertSee('Desk lamp')
            ->assertSee('Brass reading lamp')
            ->assertSee('29.95');

        $this->get(route('items.show', $item))
            ->assertOk()
            ->assertSee('Brass reading lamp');
    }

    public function test_item_can_be_created_and_invalid_values_are_rejected(): void
    {
        $this->from(route('items.create'))
            ->post(route('items.store'), [
                'name' => '',
                'quantity' => -1,
                'price' => -1,
            ])
            ->assertRedirect(route('items.create'))
            ->assertSessionHasErrors(['name', 'quantity', 'price']);

        $this->post(route('items.store'), [
            'name' => 'Notebook',
            'description' => 'A5 ruled notebook',
            'quantity' => 12,
            'price' => '3.50',
        ])
            ->assertRedirect(route('items.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('items', [
            'name' => 'Notebook',
            'description' => 'A5 ruled notebook',
            'quantity' => 12,
            'price' => '3.50',
        ]);
    }

    public function test_item_can_be_updated(): void
    {
        $item = Item::create([
            'name' => 'Notebook',
            'description' => null,
            'quantity' => 2,
            'price' => '3.50',
        ]);

        $this->get(route('items.edit', $item))
            ->assertOk()
            ->assertSee('Notebook');

        $this->put(route('items.update', $item), [
            'name' => 'Hardcover notebook',
            'description' => 'Updated description',
            'quantity' => 5,
            'price' => '4.25',
        ])
            ->assertRedirect(route('items.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'name' => 'Hardcover notebook',
            'description' => 'Updated description',
            'quantity' => 5,
            'price' => '4.25',
        ]);
    }

    public function test_item_can_be_deleted(): void
    {
        $item = Item::create([
            'name' => 'Old monitor',
            'quantity' => 1,
            'price' => '99.00',
        ]);

        $this->delete(route('items.destroy', $item))
            ->assertRedirect(route('items.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('items', ['id' => $item->id]);
    }
}
