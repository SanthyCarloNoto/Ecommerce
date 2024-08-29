<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="https://js.stripe.com/v3/"></script>
    @vite('resources/js/app.js')
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tienda') }}
            </h2>
        </x-slot>

        <div class="py-12 bg-gray-100">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex">
                        <!-- Sección de productos -->
                        <div class="p-6 text-gray-900 flex-1">
                            <h3 class="text-2xl font-bold mb-6">¡Bienvenido a Nuestra Tienda!</h3>
                            
                            <!-- Ejemplo de productos -->
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                <!-- Producto 1 -->
                                <div class="border rounded-lg shadow-lg hover:shadow-2xl transition duration-300 bg-white">
                                    <img src="https://via.placeholder.com/300" alt="Imagen del Producto" class="w-full h-48 object-cover rounded-t-lg">
                                    <div class="p-4">
                                        <h4 class="font-semibold text-lg mb-2">Producto 1</h4>
                                        <p class="text-gray-700 mb-4">€10.00</p>
                                        <button class="w-full bg-green-500 hover:bg-green-600 text-black py-2 rounded transition duration-200" onclick="addToCart('Producto 1', 10.00)">
                                            Comprar
                                        </button>
                                    </div>
                                </div>

                                <!-- Producto 2 -->
                                <div class="border rounded-lg shadow-lg hover:shadow-2xl transition duration-300 bg-white">
                                    <img src="https://via.placeholder.com/300" alt="Imagen del Producto" class="w-full h-48 object-cover rounded-t-lg">
                                    <div class="p-4">
                                        <h4 class="font-semibold text-lg mb-2">Producto 2</h4>
                                        <p class="text-gray-700 mb-4">€20.00</p>
                                        <button class="w-full bg-green-500 hover:bg-green-600 text-black py-2 rounded transition duration-200" onclick="addToCart('Producto 2', 20.00)">
                                            Comprar
                                        </button>
                                    </div>
                                </div>

                                <!-- Producto 3 -->
                                <div class="border rounded-lg shadow-lg hover:shadow-2xl transition duration-300 bg-white">
                                    <img src="https://via.placeholder.com/300" alt="Imagen del Producto" class="w-full h-48 object-cover rounded-t-lg">
                                    <div class="p-4">
                                        <h4 class="font-semibold text-lg mb-2">Producto 3</h4>
                                        <p class="text-gray-700 mb-4">€15.00</p>
                                        <button class="w-full bg-green-500 hover:bg-green-600 text-black py-2 rounded transition duration-200" onclick="addToCart('Producto 3', 15.00)">
                                            Comprar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cuadro de selección / carrito -->
                        <div id="cart" class="w-1/4 p-6 bg-gray-200 border-l border-gray-300">
                            <h3 class="text-xl font-bold mb-4">Carrito</h3>
                            <div id="cart-items" class="space-y-4">
                                <!-- Los productos seleccionados se agregarán aquí -->
                            </div>
                            <div class="mt-4 font-semibold">
                                Total: <span id="total-price">€0.00</span>
                            </div>
                            <button id="checkout-button" class="w-full bg-blue-500 hover:bg-blue-600 text-black py-2 rounded transition duration-200 mt-4" onclick="processPayment()">
                                Realizar Pago
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const stripe = Stripe('pk_test_51Psjz2EbhasqP38cPKTaDxqEnfefw9f1QqenMTAtLDAOLNl2D1NAdoPPJbGDRovtAchkfQ5OsS60aI6BI3SpqX6b00PQjnWB5i');
            const cartItemsContainer = document.getElementById('cart-items');
            const totalPriceElement = document.getElementById('total-price');
            let totalPrice = 0;

            function addToCart(productName, amount) {
                // Agregar producto al carrito
                const itemElement = document.createElement('div');
                itemElement.className = 'p-2 border rounded bg-white shadow-sm mb-2';
                itemElement.innerHTML = `
                    <div class="flex justify-between items-center">
                        <span>${productName}</span>
                        <span>€${amount.toFixed(2)}</span>
                    </div>
                `;
                cartItemsContainer.appendChild(itemElement);

                // Actualizar total
                totalPrice += amount;
                totalPriceElement.textContent = `€${totalPrice.toFixed(2)}`;
            }

            async function processPayment() {
                // Redirigir a la página de pago con el monto total
                window.location.href = `/stripe?amount=${totalPrice}`;
            }
        </script>
    </x-app-layout>
</body>
</html>
