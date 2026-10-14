@extends('layouts.app')

@section('title', 'Item Management System')

@section('content')
    <x-creator-profile />

    <div class="inventory-section" id="items">
        <div class="page-heading">
            <div>
                <p class="eyebrow">Your workspace</p>
                <h2>Item inventory</h2>
                <p class="page-description">Create and manage your item records.</p>
            </div>
            <a class="button button-primary" href="{{ route('items.create') }}">Add Item</a>
        </div>

        <section class="card" aria-label="Items list">
            @if ($items->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon" aria-hidden="true">＋</div>
                    <h3>No items yet</h3>
                    <p>Add your first item to see it listed here.</p>
                    <a class="button button-primary" href="{{ route('items.create') }}">Add your first item</a>
                </div>
            @else
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col"><span class="visually-hidden">Actions</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td class="item-name">{{ $item->name }}</td>
                                    <td class="description-cell">{{ $item->description ?? '—' }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>
                                        <div class="row-actions">
                                            <a class="button button-small button-secondary" href="{{ route('items.show', $item) }}">View</a>
                                            <a class="button button-small button-secondary" href="{{ route('items.edit', $item) }}">Edit</a>
                                            <form action="{{ route('items.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this item? This action cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="button button-small button-danger" type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>
    </div>
@endsection
