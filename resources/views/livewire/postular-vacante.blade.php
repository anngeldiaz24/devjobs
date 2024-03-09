<div class="bg-gray-800 p-5 mt-10 flex flex-col justify-center items-center">
    <h3 class="text-center text-2xl font-bold my-4">Apply for this job</h3>

    <form wire:submit.prevent='postularme' class="w-96 mt-5">
        <div class="mb-4">
            <x-input-label for="cv" :value="__('Curriculum or Resume (PDF)')" />

            <x-text-input id="cv" type="file" 
                            wire:model="cv"
                            class="block mt-1 w-full"
                            accept=".pdf" />
            <x-input-error :messages="$errors->get('cv')" class="mt-2" />
        </div>
        <x-primary-button class="my-5">
            {{ __('Apply') }}
        </x-primary-button>
    </form>

</div>
