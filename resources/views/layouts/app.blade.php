<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Item Management System')</title>
    @vite('resources/css/app.css')
</head>
<body>
    <header class="site-header">
        <div class="container header-content">
            <a class="brand" href="{{ route('items.index') }}">Item Management System</a>
            <nav class="header-nav" aria-label="Main navigation">
                <a href="{{ route('items.index') }}#creator">Creator</a>
                <a href="{{ route('items.index') }}#items">Items</a>
                <a class="button button-nav" href="{{ route('items.create') }}">Add item</a>
            </nav>
        </div>
    </header>

    <main class="container page-content">
        @if (session('success'))
            <div class="alert alert-success" role="status">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error" role="alert">
                <p>Please correct the following errors:</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>
