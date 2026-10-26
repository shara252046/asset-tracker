<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Add New Asset</h1>
        <form method="POST" action="{{ route('assets.store') }}" class="bg-white shadow rounded p-6">
            @include('assets._form')
        </form>
    </div>
</x-app-layout>