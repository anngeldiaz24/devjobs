{{-- We send the information through the editarVacante method --}}
<form class="md:w-1/2 space-y-5" wire:submit.prevent='editarVacante'>
    <div>
        {{-- Metodos del ciclo de vida --}}
        {{-- Class Hooks livewire -> utilizamos mount --}}
        <x-input-label class="text-left" for="titulo" :value="__('Vacant Title')" />
        <x-text-input 
            id="titulo" 
            class="block mt-1 w-full" 
            type="text"
            {{-- Instead of using name, we use wire:model to communicate front with back --}}
            wire:model="titulo" 
            :value="old('titulo')" 
            placeholder="Write a title for the vacancy..."
        />
        @error('titulo')
            <livewire:error-component :message="$message" />    
        @enderror
        {{-- <x-input-error :messages="$errors->get('titulo')" class="mt-2" /> --}}
    </div>
    <div>
        <x-input-label class="text-left" for="salario" :value="__('Monthly Salary')" />
        <select id="salario" wire:model="salario" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full">
            <option selected hidden>Select Average Salary</option>
            @foreach ($salarios as $salario)
                <option value="{{ $salario->id }}">{{ $salario->salario }}</option>
            @endforeach
        </select>
        @error('salario')
            <livewire:error-component :message="$message" />    
        @enderror
        {{-- <x-input-error :messages="$errors->get('salario')" class="mt-2" /> --}}
    </div>
    <div>
        <x-input-label class="text-left" for="categoria" :value="__('Monthly Salary')" />
        <select id="categoria" wire:model="categoria" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full">
            <option selected hidden>Select Category</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
            @endforeach
        </select>
        @error('categoria')
            <livewire:error-component :message="$message" />    
        @enderror
        {{-- <x-input-error :messages="$errors->get('categoria')" class="mt-2" /> --}}
    </div>
    <div>
        <x-input-label class="text-left" for="empresa" :value="__('Company´s Name')" />
        <x-text-input 
            id="empresa" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="empresa" 
            :value="old('empresa')" 
            placeholder="Company: Netflix, IBM, Uber, Google"
        />
        @error('empresa')
            <livewire:error-component :message="$message" />    
        @enderror
        {{-- <x-input-error :messages="$errors->get('empresa')" class="mt-2" /> --}}
    </div>
    <div>
        <x-input-label class="text-left" for="ultimo_dia" :value="__('Last Day to Apply')" />
        <x-text-input 
            id="ultimo_dia" 
            class="block mt-1 w-full" 
            type="date" 
            wire:model="ultimo_dia" 
            :value="old('ultimo_dia')" 
        />
        @error('ultimo_dia')
            <livewire:error-component :message="$message" />    
        @enderror
        {{-- <x-input-error :messages="$errors->get('ultimo_dia')" class="mt-2" /> --}}
    </div>
    <div>
        <x-input-label class="text-left" for="descripcion" :value="__('General Job Description')" />
        <textarea
            id="descripcion"
            wire:model="descripcion"
            placeholder="Skills and experience required"
            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full h-72"
        ></textarea>
        @error('descripcion')
            <livewire:error-component :message="$message" />    
        @enderror
        {{-- <x-input-error :messages="$errors->get('descripcion')" class="mt-2" /> --}}
    </div>
    <div>
        <x-input-label class="text-left" for="imagen" :value="__('Image')" />
        <x-text-input 
            id="imagen" 
            class="block mt-1 w-full" 
            type="file" 
            wire:model="imagen_nueva" 
            {{-- Acepta imagenes de la cualquier tipo, no videos, ni archivos --}}
            accept="image/*"
        />
        {{-- Preview of the image --}}
        <div class="my-5 w-80">
            <x-input-label class="text-left" :value="__('Current Image')" />
                {{-- asset target to the public directory in storage --}}
                {{-- php artisan storage:link -> nos permite visualizar la imagen--}} 
                <img src="{{ asset('storage/vacantes/' . $imagen) }}" alt="{{ 'Current Vacancy ' . $titulo }}"/>
        </div>
        {{-- Preview of the image --}}
        <div class="my-5 w-80">
            @if ($imagen_nueva)
            <x-input-label class="text-left" :value="__('New Image')" />
                <img src="{{ $imagen_nueva->temporaryUrl() }}" />
            @endif
        </div>

        @error('imagen_nueva')
            <livewire:error-component :message="$message" />    
        @enderror
        {{-- <x-input-error :messages="$errors->get('imagen')" class="mt-2" /> --}}
    </div>

    <x-primary-button class="w-full justify-center">
        {{ __('Modify Vacancy') }}
    </x-primary-button>
</form>