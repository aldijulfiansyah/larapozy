<div class="p-6">
    <x-button wire:click="showCreateModal">
        {{ __('Create') }}
    </x-button>

    <x-dialog-modal wire:model.live="modalVisible">
        <x-slot name="title">
            {{ __('Save Page') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="title" value="{{ __('Title') }}" />
                <x-input id="title" class="block mt-1 w-full" type="text" wire:model="title" wire:keyup="updateSlug" />
                @error('title') <span class="text-red-600">{{$message}}</span> @enderror
            </div>
            <div class="mt-4">
                <x-label for="slug" value="{{ __('Slug') }}" />
                <div class="flex flex-row">
                    <span class="p-2 bg-gray-400 rounded-l-md shadow-sm flex text-black items-center">localhost:8000/</span>
                    <input type="text" id="slug" placeholder="url-slug" class="rounded-r-md border-gray-300 shadow-sm w-full" wire:model="slug" readonly>
                </div>
                @error('slug') <span class="text-red-600">{{$message}}</span> @enderror
            </div>
            <div class="mt-4">
                <x-label for="content" value="{{ __('Content') }}" />
                <div>
                    <div class="mt-1 bg-white text-black">
                        <div class="body-content" wire:ignore>
                            <trix-editor 
                            class="trix-content"
                            x-ref="trix"
                            wire:model.debounce.800ms="content"
                            wire:key="trix-content-unique-key"
                            ></trix-editor>
                        </div> 
                    </div>
                </div>
                @error('content') <span class="text-red-600">{{$message}}</span> @enderror
            </div>

            
           
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-3" wire:click="create" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
