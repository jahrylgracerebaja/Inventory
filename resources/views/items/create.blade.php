@extends('layouts.app')

@section('title', 'Add Item | Item Management System')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Inventory</p>
            <h1>Add an item</h1>
            <p class="page-description">Enter the details for the new item.</p>
        </div>
    </div>

    <section class="card form-card">
        <form action="{{ route('items.store') }}" method="POST">
            @csrf
            @include('items._form', ['submitLabel' => 'Add Item'])
        </form>
    </section>
@endsection
