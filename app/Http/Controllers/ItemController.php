<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ItemController extends Controller
{
    public function index(): View
    {
        $items = Item::query()->orderBy('name')->get();

        return view('items.index', compact('items'));
    }

    public function create(): View
    {
        return view('items.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $item = Item::create($this->validatedData($request));

        return redirect()
            ->route('items.index')
            ->with('success', "{$item->name} was added successfully.");
    }

    public function show(Item $item): View
    {
        return view('items.show', compact('item'));
    }

    public function edit(Item $item): View
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item): RedirectResponse
    {
        $item->update($this->validatedData($request));

        return redirect()
            ->route('items.index')
            ->with('success', "{$item->name} was updated successfully.");
    }

    public function destroy(Item $item): RedirectResponse
    {
        $name = $item->name;
        $item->delete();

        return redirect()
            ->route('items.index')
            ->with('success', "{$name} was deleted successfully.");
    }

    /**
     * @return array{name: string, description: ?string, quantity: int, price: string}
     */
    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'quantity' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
        ]);

        return [
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'quantity' => (int) $data['quantity'],
            'price' => (string) $data['price'],
        ];
    }
}
