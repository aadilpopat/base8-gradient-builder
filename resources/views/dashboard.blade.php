<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">My Gradients</h2>
            <a href="{{ route('gradients.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                New Gradient
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if($gradients->isEmpty())
                <p class="text-gray-500">You haven't created any gradients yet.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($gradients as $gradient)
                        <div class="bg-white rounded-xl shadow overflow-hidden">
                            <div class="h-32 w-full" style="background: {{ $gradient->type === 'linear' ? 'linear' : 'radial' }}-gradient({{ $gradient->type === 'linear' ? $gradient->angle . 'deg' : 'circle' }}, {{ $gradient->color_1 }}, {{ $gradient->color_2 }})">
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800">{{ $gradient->name }}</h3>
                                <p class="text-sm text-gray-500 capitalize">{{ $gradient->type }} gradient</p>
                                <div class="mt-4 flex items-baseline gap-2">
                                    <a href="{{ route('gradients.edit', $gradient) }}" 
                                       class="text-sm text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('gradients.destroy', $gradient) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-sm text-red-500 hover:underline"
                                                onclick="return confirm('Delete this gradient?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>