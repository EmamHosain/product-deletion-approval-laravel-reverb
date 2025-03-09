<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h1 class="text-2xl font-bold mb-4">All Users</h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($users as $user)
                        <div class="bg-white shadow-md rounded-lg p-4">
                            <h2 class="text-lg font-semibold">{{ $user->name }}</h2>
                            <p class="text-gray-500">{{ $user->email }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>


    <script>
        document.addEventListener('livewire:initialized', () => {
            let user_id = `{{ $user_id }}`;
            let component = @this;
            let productDelete = null;

            window.Echo.private(`admin-notification-channel.${user_id}`)
                .listen('AdminNotificationEvent', (event) => {
                    console.log('Notification received:', event);
                    // component.callFun(event.product_id);

                    let productName = event.product_name;
                    let userName = event.user_name;

                    // sweet alert fire start here
                    Swal.fire({
                        title: "Are You Agree?",
                        text: `${userName} wants to delete his product is : ${productName}`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "OK, I Agree!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // comfirm
                            productDelete = "YES";
                            component.sendProductDeletePermission(event.user_id, event.product_id,
                                productDelete)
                        } else {
                            // not confirm
                            productDelete = "NO";
                            component.sendProductDeletePermission(event.user_id, event.product_id,
                                productDelete)

                        }
                    });
                    // sweet alert fire end here






                });
        })
    </script>
</div>
