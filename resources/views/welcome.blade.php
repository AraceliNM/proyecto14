<x-app-layout>
    <div class="container-menu py-8">
        @foreach($categories as $category)
            <section class="mb-6">
                <h1 class="text-lg uppercase font-semibold text-gray-700">
                    {{ $category->name }}
                </h1>

                @livewire('category-products', ['category' => $category])
            </section>
        @endforeach
    </div>

    @push('scripts')
        <script>
            Livewire.on('glider', function (id) {
                new Glider(document.querySelector('.glider-' + id), {
                    slidesToShow: 5.5,
                    slidesToScroll: 5,
                    draggable: true,
                    dots: '.glider-' + id + '~.dots',
                    arrows: {
                        prev: '.glider-' + id + '~.glider-prev',
                        next: '.glider-' + id + '~.glider-next'
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
