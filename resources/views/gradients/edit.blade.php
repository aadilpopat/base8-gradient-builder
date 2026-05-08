<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Gradient
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Preview Box -->
                <div id="preview" class="w-full h-48 rounded-lg mb-6"></div>

                <form method="POST" action="{{ route('gradients.update', $gradient) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" value="{{ $gradient->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Type</label>
                        <select name="type" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="linear" {{ $gradient->type === 'linear' ? 'selected' : '' }}>Linear</option>
                            <option value="radial" {{ $gradient->type === 'radial' ? 'selected' : '' }}>Radial</option>
                        </select>
                    </div>

                    <div class="mb-4" id="angle-wrapper">
                        <label class="block text-sm font-medium text-gray-700">Angle: <span id="angle-label">{{ $gradient->angle }}</span>°</label>
                        <input type="range" name="angle" id="angle" min="0" max="360" value="{{ $gradient->angle }}" class="mt-1 block w-full">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Colour 1</label>
                        <input type="color" name="color_1" id="color_1" value="{{ $gradient->color_1 }}" class="mt-1 block cursor-pointer">
                    </div>

                    <div class="mb-12">
                        <label class="block text-sm font-medium text-gray-700">Colour 2</label>
                        <input type="color" name="color_2" id="color_2" value="{{ $gradient->color_2 }}" class="mt-1 block cursor-pointer">
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-800 tranistion">Update Gradient</button>

                        <form action="{{ route('gradients.destroy', $gradient) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition"
                                                onclick="return confirm('Delete this gradient?')">
                                            Delete
                                        </button>
                                    </form>

                        <a href="{{ route('gradients.index') }}" class="bg-gray-200 text-gray-700 hover:bg-gray-400 hover:text-white transition px-4 py-2 rounded-md">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const preview = document.getElementById('preview');
        const color1 = document.getElementById('color_1');
        const color2 = document.getElementById('color_2');
        const angle = document.getElementById('angle');
        const angleLabel = document.getElementById('angle-label');
        const type = document.getElementById('type');
        const angleWrapper = document.getElementById('angle-wrapper');

        function updatePreview() {
            const c1 = color1.value;
            const c2 = color2.value;
            const a = angle.value;
            const t = type.value;

            angleWrapper.style.display = t === 'radial' ? 'none' : 'block';

            if (t === 'radial') {
                preview.style.background = `radial-gradient(circle, ${c1}, ${c2})`;
            } else {
                preview.style.background = `linear-gradient(${a}deg, ${c1}, ${c2})`;
            }

            angleLabel.textContent = a;
        }

        // Run on load so preview shows existing values immediately
        updatePreview();

        color1.addEventListener('input', updatePreview);
        color2.addEventListener('input', updatePreview);
        angle.addEventListener('input', updatePreview);
        type.addEventListener('change', updatePreview);
    </script>
</x-app-layout>