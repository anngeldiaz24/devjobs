<div>
    <livewire:filtrar-vacantes />
    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <h3 class="font-extrabold text-4xl text-gray-700 mb-12 dark:text-white">Our available vacancies </h3>
            
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 divide-gray-200">
                @forelse ($vacantes as $vacante)
                    <div class="md:flex md:justify-between md:items-center py-5">
                        <div class="md:flex-1 sm:mt-10">
                            <a class="text-3xl font-extrabold text-gray-600 dark:text-white" href="{{ route('vacantes.show', $vacante->id) }}">{{ $vacante->titulo }}</a>
                            <p class="text-base text-gray-600 dark:text-white">{{ $vacante->empresa }}</p>
                            <p class="font-bold text-xs dark:text-white">
                                Last day to apply:
                                <span class="dark:text-white">{{ $vacante->ultimo_dia->format('d/m/Y') }}</span>
                            </p>
                        </div>
                        <div class="mt-5 md_mt-0">
                            <a class="bg-indigo-600 px-4 py-2 md:text-sm text-xs uppercase font-bold text-white rounded-lg inline-block" href="{{ route('vacantes.show', $vacante->id) }}">See details</a>
                        </div>
                    </div>
                @empty
                    <p class="p-3 text-center text-sm text-gray-600 dark:text-white">There are no vacancies yet</p>
                @endforelse
            </div>
            
        </div>
    </div>
</div>
