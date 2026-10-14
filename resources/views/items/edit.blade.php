@extends('layouts.app')

@section('title', 'Edit Item | Item Management System')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Inventory</p>
            <h1>Edit item</h1>
            <p class="page-description">Update the details for {{ $item->name }}.</p>
        </div>
    </div>

    <section class="card form-card">
        <form action="{{ route('items.update', $item) }}" method="POST">
            @csrf
            @method('PUT')
            @include('items._form', ['submitLabel' => 'Save Changes'])
        </form>
    </section>
@endsection
