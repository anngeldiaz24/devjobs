<div class="p-10 dark:text-white">
    <div class="mb-5">
        <h3 class="font-bold text-3xl text-gray-800 my-3 dark:text-white">
            {{ $vacante->titulo }}
        </h3>
        <div class="md:grid md:grid-cols-2 p-4 my-10">
            <p class="font-bold text-sm uppercase text-gray-800 my-3 dark:text-white">Company: 
                <span class="normal-case font-normal">{{ $vacante->empresa }}</span>
            </p>
            <p class="font-bold text-sm uppercase text-gray-800 my-3 dark:text-white">Last day to apply: 
                <span class="normal-case font-normal">{{ $vacante->ultimo_dia->toFormattedDateString() }}</span>
            </p>
            <p class="font-bold text-sm uppercase text-gray-800 my-3 dark:text-white">Category: 
                <span class="normal-case font-normal">{{ $vacante->categoria->categoria }}</span>
               {{--  Modelo->relacion->campo --}}
            </p>
            <p class="font-bold text-sm uppercase text-gray-800 my-3 dark:text-white">Salary: 
                <span class="normal-case font-normal">{{ $vacante->salario->salario }}</span>
            </p>
        </div>
    </div>


    <div class="md:grid md:grid-cols-6 gap-4">
        <div class="md:col-span-2">
            <img src="{{ asset('storage/vacantes/' . $vacante->imagen) }}" alt="{{ 'Vacancy Image '. $vacante->titulo }}">
        </div>
        <div class="md:col-span-4">
            <h2 class="text-2xl dont-bold mb-5">Job Description: </h2>
            <p>{{ $vacante->descripcion }}</p>
        </div>
    </div>

    @guest
        <div class="mt-5 border-dahsed p-5 text-center dark:text-white">
            <p>
                Would you like to apply for this job? <a class="font-bold text-indigo-600"  href="{{ route('register') }}">Get an Account</a>
            </p>
        </div>
    @endguest

    @if (Auth::user())
        {{--  Un usuario con rol de reclutador no puede aplicar para la vacante a través de policy --}}
        @cannot('create', App\Models\Vacante::class)
            <livewire:postular-vacante :vacante="$vacante" />
        @endcannot
    @endif

</div>
