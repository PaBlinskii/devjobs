<div>
    @push('styles')
    <link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">
    @endpush
    
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    
        {{--  Mostrando todas las vacantes publicadas  --}}
        @forelse ($vacantes as $vacante)
            <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
                <div class="leading-10">
                    <a href="{{ route('vacantes.show', $vacante->id) }}" class="text-xl font-bold">
                        {{ $vacante->titulo }}
                    </a>
                    <p class="text-sm text-gray-600 font-bold">{{ $vacante->empresa }}</p>
                    {{-- A pesar que ultimo_dia es tipo date, laravel lo toma como string, por lo tanto hay que modificar el modelo --}}
                    <p class="text-sm text-gray-500">último día: {{ $vacante->ultimo_dia->format('d/m/Y' ) }}</p>
                </div>

                {{-- MOSTRANDO LOS CANDIDATOS DE LA VACANTE --}}
                <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0">
                    <a 
                        href="{{ route('candidatos.index', $vacante) }}"
                        class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center"
                    >
                    {{ $vacante->candidatos->count()}}
                    Candidatos</a>

                    <a 
                        href="{{ route('vacantes.edit', $vacante->id) }}"
                        class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center"
                    >Editar</a>

                    <button
                        wire:click="$emit('mostrarAlerta', {{ $vacante->id }})"
                        class="bg-red-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center"
                    >Eliminar</button>
                </div>
            </div>
        @empty 
            <p class="p-3 text-center text-sm text-gray-600">No hay Vacantes que mostrar</p>            
        @endforelse 

    </div>

    <div class="mt-10">
        {{ $vacantes->links() }}
    </div>

    @push('scripts')
 
    <script src="{{asset('js/sweetalert2.min.js')}}"></script>
    
    <script>
        Livewire.on('mostrarAlerta', vacanteId => {
            Swal.fire({
            title: '¿Eliminar Vacante?',
            text: "Una vacante eliminada no se puede recuperar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, ¡Eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Eliminar Vacante
                Livewire.emit('eliminarVacante', vacanteId)

                Swal.fire(
                    'Se Elmininó la Vacante!',
                    'Eliminado Correctamente.',
                    'success'
                )
            }
        })
        })
    </script>
 
@endpush

</div>






{{-- Esta manera del Profe Juan no funcionó
@push('scripts')
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Swal.fire({
            title: '¿Eliminar Vacante?',
            text: "Una vacante eliminada no se puede recuperar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, ¡Eliminar!'
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    '¡Elminado!',
                    'La Vacante ha sido eliminada.',
                    'success'
                )
            }
        })
    </script>

@endpush --}}

{{-- También se puede así normalmente --}}
{{-- 
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

    @if (count($vacantes) > 0)
        

        @foreach ($vacantes as $vacante)
            <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
                <div class="leading-10">
                    <a href="#" class="text-xl font-bold">
                        {{ $vacante->titulo }}
                    </a>
                    <p class="text-sm text-gray-600 font-bold">{{ $vacante->empresa }}</p>

                    <p class="text-sm text-gray-500">último día: {{ $vacante->ultimo_dia->format('d/m/Y' ) }}</p>
                </div>

                <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0">
                    <a 
                        href="#"
                        class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center"
                    >Candidatos</a>

                    <a 
                        href="#"
                        class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center"
                    >Editar</a>

                    <a 
                        href="#"
                        class="bg-red-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center"
                    >Eliminar</a>
                </div>
            </div>
        @endforeach 

    @else 
            <p class="p-3 text-center text-sm text-gray-600">No hay Vacantes que mostrar</p>
    @endif

</div> 
--}}