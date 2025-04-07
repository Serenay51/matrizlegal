{{-- filepath: c:\Users\Lauty\Desktop\Trabajo\SERSEGPROGRAM\matrizlegal\resources\views\payment.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Formulario de Pago') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Suscripción Premium</h3>
                    <p class="mb-4">Completa el formulario para realizar el pago de tu suscripción mensual.</p>

                    {{-- Formulario de pago falso --}}
                    <form id="payment-form" method="POST" action="#">
                        @csrf
                        <div class="mb-4">
                            <label for="card-number" class="block text-sm font-medium">Número de tarjeta</label>
                            <input type="text" id="card-number" name="card_number" placeholder="1234 5678 9012 3456"
                                   class="w-full p-2 border rounded-md text-gray-900">
                        </div>
                        <div class="mb-4">
                            <label for="expiry-date" class="block text-sm font-medium">Fecha de expiración</label>
                            <input type="text" id="expiry-date" name="expiry_date" placeholder="MM/AA"
                                   class="w-full p-2 border rounded-md text-gray-900">
                        </div>
                        <div class="mb-4">
                            <label for="cvv" class="block text-sm font-medium">CVV</label>
                            <input type="text" id="cvv" name="cvv" placeholder="123"
                                   class="w-full p-2 border rounded-md text-gray-900">
                        </div>
                        <button type="button" id="pay-button" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Pagar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- SweetAlert2 Script --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('pay-button').addEventListener('click', function () {
            // Simular el pago y mostrar el popup
            Swal.fire({
                title: '¡Suscripción pagada!',
                text: 'Tu suscripción premium ha sido activada con éxito.',
                icon: 'success',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#4CAF50'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar una solicitud al servidor para actualizar el estado del usuario
                    fetch('{{ route("update.admin.status") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ is_admin: 1, bloqueado: 0})
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Redirigir al usuario al dashboard
                            window.location.href = '{{ route("dashboard") }}';
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: 'No se pudo activar la suscripción. Inténtalo nuevamente.',
                                icon: 'error',
                                confirmButtonText: 'Aceptar'
                            });
                        }
                    });
                }
            });
        });
    </script>
</x-app-layout>