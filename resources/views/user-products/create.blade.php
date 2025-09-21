<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User & Products</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="w-full max-w-3xl mx-auto px-6 py-10">
        <!-- Header -->
        <div class="mb-8 text-center">
            <h2 class="text-3xl font-bold text-gray-900">Create User & Products</h2>
            <p class="mt-2 text-gray-600">Fill out the form below to add a new user with product details.</p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('users.store') }}" class="bg-white rounded-xl shadow-lg border border-gray-200 p-8 space-y-8">
            @csrf

            <!-- User Info -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">User Info</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <input type="text" name="name" placeholder="Name" required
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <input type="text" name="username" placeholder="Username" required
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <input type="text" name="phone" placeholder="Phone" required
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <input type="email" name="email" placeholder="Email" required
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <input type="password" name="password" placeholder="Password" required
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:col-span-2">
                </div>
            </div>

            <!-- Products -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Products</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 items-center">
                    <input type="text" name="products[0][product_name]" placeholder="Product Name"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <input type="number" name="products[0][price]" placeholder="Price"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <input type="number" name="products[0][quantity]" placeholder="Qty"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">

                    <!-- Product Type -->
                    <select name="products[0][product_type]" id="productType"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="flat">Flat</option>
                        <option value="discount">Discount</option>
                    </select>

                    <!-- Discount -->
                    <input type="number" name="products[0][discount]" id="discountInput" placeholder="Discount"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>

            <!-- Submit -->
            <div class="text-center">
                <button type="submit"
                    class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors">
                    Save User & Products
                </button>
            </div>
        </form>
    </div>

    <!-- JS to disable discount when type is flat -->
    <script>
        const productType = document.getElementById('productType');
        const discountInput = document.getElementById('discountInput');

        function toggleDiscount() {
            if (productType.value === 'flat') {
                discountInput.value = 0;
                discountInput.setAttribute('readonly', true);
                discountInput.classList.add('bg-gray-200', 'cursor-not-allowed');
            } else {
                discountInput.removeAttribute('readonly');
                discountInput.classList.remove('bg-gray-200', 'cursor-not-allowed');
            }
        }

        // Run on page load + on change
        toggleDiscount();
        productType.addEventListener('change', toggleDiscount);
    </script>

</body>
</html>
