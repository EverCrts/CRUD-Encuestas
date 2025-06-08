@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-12 min-h-screen">
        <h1 class="text-3xl font-bold mb-6 text-center text-neutral-200">Encuestas Disponibles</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            @forelse ($surveys as $survey)
                <x-survey-card 
                    :name="$survey->name" 
                    :description="$survey->description" 
                    :miniature="$survey->miniature" />
            @empty
                <div class="text-center text-neutral-200">
                    No hay encuestas disponibles.
                </div>
            @endforelse
        </div>

        @if ($surveys->hasPages())
            <div class="flex justify-center">
                {{ $surveys->links() }}
            </div>
        @endif
    </div>
@endsection