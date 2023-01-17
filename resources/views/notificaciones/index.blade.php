<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Vacante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold text-center my-10">Mis Notificaciones</h1>
                    
                    {{-- Este div lo creamos para organizar mejor las notificaciones --}}
                    <div class="divide-y divide-gray-200">
                        @forelse ($notificaciones as $notificacion)
                            <div class="p-5 border rounded-lg mb-1 bg-gray-50 border-gray-200 lg:flex lg:justify-between lg:items-center">
                                <div>
                                    <p>Tienes un nuevo candidato en:
                                        <span class="font-bold">{{ $notificacion->data['nombre_vacante'] }}</span>
                                    </p>
                                
                                    <p>
                                        <span class="font-bold">{{ $notificacion->created_at->diffForHumans() }}</span>
                                    </p>
                                </div>

                                <div class="mt-5 lg:mt-0">
                                    {{-- Accedemos a la ruta del id de la vacante de la tabla de notificaciones --}}
                                    <a href="{{ route('candidatos.index', $notificacion->data['id_vacante']) }}" class="bg-indigo-500 p-3 text-sm uppercase font-bold text-white rounded-lg">
                                        Ver Candidatos
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-600">No hay Notificaciones Nuevas</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
