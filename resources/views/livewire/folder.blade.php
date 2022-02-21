<div>
@if(count($items) > 0)
@foreach ($items as $item)
    <div>
        <div class="flex justify-center">
            <div class=" relative justify-center mt-6">
                <div class="absolute flex top-0 right-0 p-3 space-x-1">
                    <button wire:click="openModal({{ $item }})">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </span>
                    </button>
                    <button wire:click="deleteItem({{ $item->id }})">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </span>
                    </button>
                    <div class="form-check">
                        @if($item->done == true)
                        <input class="form-check-input appearance-none h-6 w-6 border border-gray-300 rounded-sm bg-white checked:bg-green-600 checked:border-green-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" wire:click="done({{$item->id}})" type="checkbox" checked>   
                        @else
                        <input class="form-check-input appearance-none h-6 w-6 border border-gray-300 rounded-sm bg-white checked:bg-green-600 checked:border-green-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" wire:click="done({{$item->id}})" type="checkbox">
                        @endif
                    </div>
                </div>
                    <span class="absolute -left-3 -top-3 bg-green-500 flex justify-center items-center rounded-full w-8 h-8 text-gray-50 font-bold"> {{$item->id}} </span>
                    <p class="bg-white px-12 py-8 rounded-lg w-80">{{ $item->data }}</p>
                </div>
                
        </div>
    </div>
@endforeach
@else
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
    <strong class="font-bold">Hey!</strong>
    <span class="block sm:inline">Nothing to show. Add some tasks!</span>
  </div>
@endif

<div class="hidden sm:block" aria-hidden="true">
    <div class="py-5">
      <div class="border-t border-gray-200"></div>
    </div>
</div>

<div class="mx-4 my-4">
    <div class="md:grid md:grid-cols-4 md:gap-6">
        <div class="mt-5 md:mt-0 md:col-start-2 md:col-span-2">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    
                        <div class="col-span-6 sm:col-span-2">
                            <x-jet-label value="To-do Task"/>
                            <x-jet-input class="w-full" type="text" wire:model="data"/>
                            <x-jet-input-error for="data"/>
                        </div>

                        <div class="pt-6 text-right">
                            <x-jet-button class="" wire:click="storeItem()" wire:loading.attr="disabled">
                                {{ __('Add Item') }}
                            </x-jet-button>
                        </div>
                </div>
            </div>
        </div>
    </div>

<div class="text-right mt-4">
<a type="button" href="{{ url('/dashboard') }}" class="text-white bg-gray-800 hover:bg-gray-900 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-right mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-800 dark:border-gray-700">Back</a>
</div>

    <!-- Modal de edicion -->

    <x-jet-dialog-modal wire:model="openModal">
        <x-slot name="title">
            {{ __('Editar Task') }}
        </x-slot>

        <x-slot name="content">
          <x-jet-input class="w-full" type="text" wire:model="data"/>
          <x-jet-input-error for="data"/>
        </x-slot>

        <x-slot name="footer">
          <x-jet-button class="" wire:click="edit()" wire:loading.attr="disabled">
              {{ __('Confirm Task') }}
          </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

<!-- Cierro Modal -->
</div>