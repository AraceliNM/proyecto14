<div>
    <div class="my-12 bg-white shadow-lg rounded-lg p-6">
        <div class="mb-6">
            <x-jet-label>
                Color
            </x-jet-label>
            <div class="grid grid-cols-6 gap-6">
                @foreach ($colors as $color)
                    <label>
                        <input type="radio" name="color_id" wire:model.defer="color_id" value="{{ $color->id }}">
                        <span class="ml-2 text-gray-700 capitalize">
                            {{ __(ucfirst($color->name)) }}
                        </span>
                    </label>
                @endforeach
            </div>
            <x-jet-input-error for="color_id" />
        </div>
    </div>

    <div>
        <x-jet-label>
            Cantidad
        </x-jet-label>

        <x-jet-input type="number" wire:model.defer="quantity" placeholder="Ingrese una cantidad" class="w-full" />
        <x-jet-input-error for="quantity" />
    </div>

    <div class="flex justify-end items-center mt-4">
        <x-jet-action-message class="mr-3" on="saved">
            Agregado
        </x-jet-action-message>
        <x-jet-button wire:loading.attr="disabled" wire:target="save" wire:click="save">
            Agregar
        </x-jet-button>
    </div>
</div>
