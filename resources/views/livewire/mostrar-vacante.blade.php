<div class="p-10">
    <div class="mb-5">
        <h3 class="font-bold text-3xl text-gray-800 my-3">
            {{$vacante->titulo}}
        </h3>

        <div class="md:grid md:grid-cols-2 bg-gray-50 p-4 my-10">
            <p class="font-bold text-sm uppercase text-gray-800 my-3">Empresa:
                <span class="normal-case font-normal">{{$vacante->empresa}}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Último día para postularse:
                <span class="normal-case font-normal">{{$vacante->ultimo_dia->toFormattedDateString()}}</span>
            </p>
            {{-- Como ya relacionamos modelo vacante belongsTo con categoria accedemos a la columna del modelo --}}
            <p class="font-bold text-sm uppercase text-gray-800 my-3">Categoria:
                <span class="normal-case font-normal">{{$vacante->categoria->categoria}}</span>
            </p>

            {{-- Como ya relacionamos modelo vacante belongsTo con salario accedemos a la columna del modelo --}}
            <p class="font-bold text-sm uppercase text-gray-800 my-3">Salario:
                <span class="normal-case font-normal">{{$vacante->salario->salario}}</span>
            </p>
        </div>
    </div>

    <div class="md:grid md:grid-cols-6 gap-4">
        {{-- Aqui le decimos que tome dos columnas para la imagen --}}
        <div class="md:col-span-2">
            <img src="{{ asset('storage/vacantes/' . $vacante->imagen ) }}" alt="{{ 'Imagen vacante' . $vacante->titulo }}">
        </div>

        {{-- Aqui le decimos que tome 4 columnas para descripción --}}
        <div class="md:col-span-4">
            <h2 class="text-2xl font-bold mb-5">Descripción del Puesto</h2>
            <p>{{ $vacante->descripcion }}</p>
        </div>
    </div>

    {{-- Para que solo lo vea un usuario no AUTENTICADO --}}
    @guest
        <div class="mt-5 bd-gray-50 border border-dashed p-5 text-center">
            <p>
                ¿Deseas aplicar a esta vacante? <a class="font-bold text-indigo-600" href="{{ route('register') }}">Obten una cuenta y aplica a esta y otras vacantes</a>
            </p>
        </div>
    @endguest

    @cannot('create', App\Models\Vacante::class)
        <livewire:postular-vacante :vacante="$vacante" />
        {{-- Coloque la variable $vacante despues de  usar el mount en PostularVacante.php--}}
    @endcannot

    {{-- Otra forma usando @Else 
        @can('create', App\Models\Vacante::class)
        <p>Este es un reclutador</p>
    @else
        <p>Este es un dev</p>
        <livewire:postular-vacante />
    @endcan --}}


</div>
