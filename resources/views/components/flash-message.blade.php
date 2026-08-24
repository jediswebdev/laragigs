@if (session()->has('message'))
    <div class="mx-auto container rounded-xl bg-laravel text-white px-48 py-3 max-w-3xl my-2">
        <p>{{ session('message') }}</p>
    </div>
@endif
