<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
    <h1 class="text-3xl text-center font-semibold mb-8">Complete los datos para crear un producto</h1>

    <div class="grid grid-cols-2 gap-6 mb-4">
        <div>
            <x-jet-label value="Categorías" />
            <select class="w-full form-control" wire:model="category_id">
                <option value="" selected disabled>Seleccione una categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <x-jet-label value="Subcategorías" />
            <select class="w-full form-control" wire:model="subcategory_id">
                <option value="" selected disabled>Seleccione una subcategoría</option>
                @foreach($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mb-4">
        <div class="mb-4">
            <x-jet-label value="Nombre" />
            <x-jet-input type="text"
                         class="w-full"
                         wire:model="name"
                         placeholder="Ingrese el nombre del producto" />
        </div>
    </div>

    <div class="mb-4">
        <x-jet-label value="Slug" />
        <x-jet-input type="text"
                     disabled
                     wire:model="slug"
                     class="w-full bg-gray-200"
                     placeholder="Ingrese el slug del producto" />
    </div>

    <div class="mb-4">
        <div wire:ignore>
            <x-jet-label value="Descripción" />
            <textarea class="w-full form-control" rows="4"
                      wire:model="description"
                      x-data
                      x-init="ClassicEditor.create($refs.miEditor)
                        .then(function(editor){
                            editor.model.document.on('change:data', () => {
                                @this.set('description', editor.getData())
                            })
                        })
                        .catch( error => {
                            console.error( error );
                        } );"
                      x-ref="miEditor">
            </textarea>
        </div>
    </div>
</div>
