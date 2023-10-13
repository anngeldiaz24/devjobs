<div> 
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        {{-- Evalua si hay vacantes --}}
        @forelse ($vacantes as $vacante)
            <div class="p-6 dark:bg-inherit bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">  
                {{-- Alineas a la izquierda de md:flex hasta el final --}}
                {{-- Incrementa el interlineado --}}
                <div class="space-y-3">
                    <a href="#" class="text-xl font-bold dark:text-gray-100">
                        {{ $vacante->titulo }}
                    </a>
                    <p class="dark:text-white text-sm text-gray-600 font-bold">{{ $vacante->empresa }}</p>
                    <p class="dark:text-white text-sm text-gray-500">Last day to apply: {{ $vacante->ultimo_dia->format('d/m/Y') }}</p>
                </div>
                
                <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0">
                    <a href="#" class="bg-slate-800 dark:bg-white py-2 px-4 rounded-lg text-whote text-xs font-bold uppercase text-center">Candidates</a>
                    {{-- Le pasamos el id al metodo edit --}}
                    <a href="{{ route('vacantes.edit', $vacante->id) }}" class="bg-blue-800 dark:bg-blue dark:text-white py-2 px-4 rounded-lg text-whote text-xs font-bold uppercase text-center">Edit</a>
                    <a href="#" class="bg-red-800 dark:bg-red dark:text-white py-2 px-4 rounded-lg text-whote text-xs font-bold uppercase text-center">Delete</a>
                </div>
            </div>
        @empty
            <p class="p-3 text-center text-sm text-gray-600">There are no vacancies available</p>
        @endforelse
        
    </div>

    {{-- Paginacion --}}
    {{-- php artisan vendor:publish --tag=laravel-pagination para que se publique el paquete --}}
    <div class="mt-10 dark:text-white">
        {{ $vacantes->links() }}
    </div>
</div>
