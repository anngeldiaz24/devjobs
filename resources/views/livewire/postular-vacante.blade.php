<div>
    <div class="dark:bg-gray-800 p-5 mt-10 flex flex-col justify-center items-center">
        <h3 class="text-center text-2xl font-bold my-4">Apply for this job</h3>

        @if (session()->has('mensaje'))
            <div class="uppercase border boder-green-600 bg-green-100 text-green-600 font-bold p-2 my-5 text-sm rounded-lg">
                {{ session('mensaje') }}
            </div>
        @else
            <form wire:submit.prevent='postularme' class="w-96 mt-5" wire:loading.class="opacity-50 pointer-events-none">
                <div class="mb-4">
                    <x-input-label for="cv" :value="__('Curriculum or Resume (PDF)')" />
                    <x-text-input id="cv" type="file" 
                                    wire:model="cv"
                                    class="block mt-1 w-full"
                                    accept=".pdf" />
                    <x-input-error :messages="$errors->get('cv')" class="mt-2" />
                </div>
                <div class="flex items-center justify-center">
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50" wire:loading.attr="disabled">
                        <span class="mr-2">{{ __('Apply') }}</span>
                        <div 
                            wire:loading wire:target="postularme"
                            class="inline-block h-4 w-4 border-t-2 border-r-2 border-b-2 border-l-2 border-white rounded-full custom-spin-animation"
                            role="status"
                        ></div>
                    </button>
                </div>
            </form>
        @endif
    </div>

    <style>
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .custom-spin-animation {
            animation: spin 1s linear infinite;
        }
    </style>
</div>
