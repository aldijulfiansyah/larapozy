<div class="p-6">
    {{-- Modal Button --}}
    <x-button class="" wire:click="showCreateModal">
        {{ __('Create') }}
    </x-button>


    {{-- Data Table --}}
    <div class="mt-4 rounded-lg border border-collapse border-gray-200 overflow-x-auto">
        <table class="table-auto w-full divide-y divide-gray-200">
            <thead>
                <tr class="text-white">
                    <th class="px-6 py-3 bg-cyan-800 text-left text-sm  leading-4 tracking-wider uppercase">
                        Title
                    </th>
                    <th class="px-6 py-3 bg-cyan-800 text-left text-sm leading-4 tracking-wider uppercase">
                        Link
                    </th>
                    <th class="px-6 py-3 bg-cyan-800  text-left text-sm  leading-4 tracking-wider uppercase">
                        Content
                    </th>
                    <th class="px-6 py-3 bg-cyan-800 text-left text-sm  leading-4 tracking-wider uppercase">

                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if ($PageData->count())
                    @foreach ($PageData as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ URL::to('/' . $item->slug) }}" class="text-indigo-600 hover:text-indigo-900">

                                    localhost:8000/{{ $item->slug }}
                                </a>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->content }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <x-secondary-button wire:click="updateModal({{ $item->id }})">
                                    {{ __('Update') }}
                                </x-secondary-button>
                                <x-danger-button wire:click="deleteModal({{$item->id}})">
                                    {{ __('Delete') }}
                                </x-danger-button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap" colspan="4">No pages data found.</td>
                    </tr>
                @endif

            </tbody>
        </table>
    </div>
    <div class="mt-1 ">
        {{ $PageData->links() }}

    </div>




    {{-- Modal --}}
    <x-dialog-modal wire:model.live="modalVisible">
        @if ($dataId)
            <x-slot name="title">
                {{ __('Update Pages - Title Name : ') }} "{{ $title }}"
            </x-slot>
        @else
            <x-slot name="title">
                {{ __('Create Pages') }}
            </x-slot>
        @endif


        <x-slot name="content">
            <div class="mt-4">
                <x-label for="title" value="{{ __('Title') }}" />
                <x-input id="title" class="block mt-1 w-full" type="text" wire:model="title"
                    wire:keyup="updateSlug" />
                @error('title')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <x-label for="slug" value="{{ __('Slug') }}" />
                <div class="flex flex-row">
                    <span
                        class="p-2 bg-gray-400 rounded-l-md shadow-sm flex text-black items-center">localhost:8000/</span>
                    <input type="text" id="slug" placeholder="url-slug"
                        class="rounded-r-md border-gray-300 shadow-sm w-full" wire:model="slug" readonly>
                </div>
                @error('slug')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <x-label for="content" value="{{ __('Content') }}" />
                <div>
                    <div class="mt-1 bg-white text-black">
                        <div class="body-content" wire:ignore>
                            <trix-editor class="trix-content" x-ref="trix" wire:model.debounce.800ms="content"
                                wire:key="trix-content-unique-key"></trix-editor>
                        </div>
                    </div>
                </div>
                @error('content')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            @if ($dataId)
                <x-button class="ml-3" wire:click="update" wire:loading.attr="disabled">
                    {{ __('Update') }}
                </x-button>
            @else
                <x-button class="ml-3" wire:click="create" wire:loading.attr="disabled">
                    {{ __('Create') }}
                </x-button>
            @endif
        </x-slot>
    </x-dialog-modal>


{{-- delete modal --}}
    <x-dialog-modal wire:model.live="modalConfirmDeleteVisible">

        @if ($dataId)
            <x-slot name="title">
                {{ __('Delete Page') }} {{$dataId}}
            </x-slot>
        @else
        <x-slot name="title">
            {{ __('Delete Page') }} {{('no data')}}
        </x-slot>
        @endif
        
       
        <x-slot name="content">
            @if($title)
            {{ __('Are you sure you want to delete this') }} <b><i>{{ $title }}</i></b> {{ __('page? Once the page is deleted, all of its resources and data will be permanently deleted.') }}
            @endif
        </x-slot>
        

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete Page') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>

</div>


