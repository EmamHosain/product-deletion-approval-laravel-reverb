<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

                @if (session()->has('status'))
                    <div x-data="{ visible: true }" x-show="visible" class="bg-green-500 text-white p-3 rounded mb-3">
                        {{ session('status') }}
                    </div>
                @endif



                <table class=" min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Product Name</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($products as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->product_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">

                                    <button type="button" wire:click='deleteProduct({{ $item->id }})'
                                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-red-500">Delete</button>


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $products->links() }}
                </div>

            </div>
        </div>
    </div>



    <script>
        document.addEventListener('livewire:initialized', function() {
            let component = @this;
            window.Echo.private(`product-delete-channel.{{ $user_id }}`).listen('ProductDeleteEvent', (
                event) => {
                console.log('event', event);
                component.ifAdminGivePermission(event.product_id, event.is_product_delete)
            })
        })
    </script>





</div>
