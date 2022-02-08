<div>
    <div class="bg-white shadow-lg rounded-lg p-6 mt-12">
        <div>
            <x-jet-label>
                Cantidad
            </x-jet-label>
            <x-jet-input
                wire:model="name"
                type="text"
                placeholder="Introduzca una talla"
                class="w-full"/>
            <x-jet-input-error for="name" />
        </div>
    </div>

    <div class="flex justify-end items-center mt-4">
        <x-jet-button wire:click="save" wire:loading.attr="disabled" wire:target="save">
            Agregar
        </x-jet-button>
    </div>

    <ul class="mt-12 space-y-4">
        @foreach ($sizes as $size)
            <li class="bg-white shadow-lg rounded-lg p-6" wire:key="size-{{ $size->id }}">
                <div class="flex items-center">
                    <span class="text-xl font-medium">{{ $size->name }}</span>
                </div>
            </li>
        @endforeach
    </ul>
</div>
