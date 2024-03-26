<div> 
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        {{-- Evalua si hay vacantes --}}
        @forelse ($vacantes as $vacante)
            <div class="p-6 dark:bg-inherit bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">  
                {{-- Alineas a la izquierda de md:flex hasta el final --}}
                {{-- Incrementa el interlineado --}}
                <div class="space-y-3">
                    <a href="{{ route('vacantes.show', $vacante->id) }}" class="text-xl font-bold dark:text-gray-100">
                        {{ $vacante->titulo }}
                    </a>
                    <p class="dark:text-white text-sm text-gray-600 font-bold">{{ $vacante->empresa }}</p>
                    <p class="dark:text-white text-sm text-gray-500">Last day to apply: {{ $vacante->ultimo_dia->format('d/m/Y') }}</p>
                </div>
                
                <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0">
                    <a href="#" class="dark:text-black dark:bg-white bg-gray-200 dark:hover:bg-gray-300 hover:bg-gray-300 py-2 px-4 rounded-lg text-xs font-bold uppercase text-center">Candidates</a>

                    {{-- Le pasamos el id al metodo edit --}}
                    <a href="{{ route('vacantes.edit', $vacante->id) }}" class="bg-blue-800 dark:bg-blue text-white py-2 px-4 rounded-lg text-whote text-xs font-bold uppercase text-center">Edit</a>
                    <button wire:click="$dispatch('mostrarAlerta', {{ $vacante->id }})" class="bg-red-800 dark:bg-red text-white py-2 px-4 rounded-lg text-whote text-xs font-bold uppercase text-center">Delete</button>
                    {{-- wire:click="prueba('{{ $vacante->id }}')" estos son eventos hacia el componente --}}
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


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Livewire.on('mostrarAlerta', (vacanteId) => {
            Swal.fire({
                title: "Are you sure you want to delete the vacancy?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    //Eliminar la vacante
                    Livewire.dispatch('eliminarVacante', {vacante: vacanteId})



                    Swal.fire({
                    title: "Deleted!",
                    text: "Vacancy deleted succesfully.",
                    icon: "success"
                    });
                }
            });
        });
    </script>
@endpush