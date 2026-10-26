<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Asset</h1>
        <form method="POST" action="{{ route('assets.update', $asset) }}" class="bg-white shadow rounded p-6">
            @method('PUT')
            @include('assets._form')
        </form>
    </div>
</x-app-layout>