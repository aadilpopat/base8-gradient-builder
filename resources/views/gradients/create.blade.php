<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Gradient
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow p-6">

                {{-- Live Preview --}}
                <div id="preview" class="h-40 rounded-lg mb-6 transition-all duration-300" 
                     style="background: linear-gradient(90deg, #6366f1, #ec4899)">
                </div>

                <form action="{{ route('gradients.store') }}" method="POST">
                    @csrf

                    {{-- Name --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="My awesome gradient">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Type --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                        <select name="type" id="type"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="linear" {{ old('type') === 'linear' ? 'selected' : '' }}>Linear</option>
                            <option value="radial" {{ old('type') === 'radial' ? 'selected' : '' }}>Radial</option>
                        </select>
                    </div>

                    {{-- Angle --}}
                    <div class="mb-4" id="angle-wrapper">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Angle: <span id="angle-value">90</span>°
                        </label>
                        <input type="range" name="angle" id="angle" 
                               min="0" max="360" value="{{ old('angle', 90) }}"
                               class="w-full">
                    </div>

                    {{-- Colours --}}
                    <div class="mb-4 flex gap-4">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Colour 1</label>
                            <input type="color" name="color_1" id="color_1" value="{{ old('color_1', '#6366f1') }}"
                                   class="w-full h-10 rounded-lg border border-gray-300 cursor-pointer">
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Colour 2</label>
                            <input type="color" name="color_2" id="color_2" value="{{ old('color_2', '#ec4899') }}"
                                   class="w-full h-10 rounded-lg border border-gray-300 cursor-pointer">
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-900 font-medium">
                        Save Gradient
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Live Preview Script --}}
    <script>
        const preview = document.getElementById('preview');
        const color1 = document.getElementById('color_1');
        const color2 = document.getElementById('color_2');
        const type = document.getElementById('type');
        const angle = document.getElementById('angle');
        const angleValue = document.getElementById('angle-value');
        const angleWrapper = document.getElementById('angle-wrapper');

        function updatePreview() {
            const c1 = color1.value;
            const c2 = color2.value;
            const t = type.value;
            const a = angle.value;

            angleValue.textContent = a;
            angleWrapper.style.display = t === 'radial' ? 'none' : 'block';

            if (t === 'linear') {
                preview.style.background = `linear-gradient(${a}deg, ${c1}, ${c2})`;
            } else {
                preview.style.background = `radial-gradient(circle, ${c1}, ${c2})`;
            }
        }

        color1.addEventListener('input', updatePreview);
        color2.addEventListener('input', updatePreview);
        type.addEventListener('change', updatePreview);
        angle.addEventListener('input', updatePreview);
    </script>
</x-app-layout>