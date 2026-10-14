@extends('layouts.app')

@section('title', $item->name . ' | Item Management System')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Inventory</p>
            <h1>{{ $item->name }}</h1>
            <p class="page-description">Item details</p>
        </div>
        <a class="button button-secondary" href="{{ route('items.index') }}">Back to items</a>
    </div>

    <section class="card details-card">
        <dl class="details-list">
            <div>
                <dt>Description</dt>
                <dd>{{ $item->description ?? 'No description provided.' }}</dd>
            </div>
            <div>
                <dt>Quantity</dt>
                <dd>{{ $item->quantity }}</dd>
            </div>
            <div>
                <dt>Price</dt>
                <dd>{{ $item->price }}</dd>
            </div>
        </dl>
        <a class="button button-primary" href="{{ route('items.edit', $item) }}">Edit Item</a>
    </section>
@endsection
