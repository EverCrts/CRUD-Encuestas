
<div class="max-w-4xl mx-auto py-12">
    <h1 class="text-3xl font-bold mb-6 text-center">Encuestas Disponibles</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($surveys as $survey)
            <div class="p-6 bg-white rounded-xl shadow-md border">
                <h2 class="text-xl font-semibold mb-2">{{ $survey->name }}</h2>
                <p class="text-gray-600 mb-4">{{ $survey->description }}</p>
                {{-- <a href="{{ route('surveys.show', $survey->id) }}" class="text-blue-500 hover:text-blue-700">
                    Ver Encuesta
                </a> --}}
            </div>
        @empty
            <div class="text-center text-gray-500">
                No hay encuestas disponibles.
            </div>
        @endforelse
    </div>
</div>
