<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="w-full max-w-7xl mx-auto px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Users List</h2>
            <p class="mt-1 text-gray-600">View and filter users by name.</p>
        </div>

        <!-- Filter Section -->
        <form method="GET" action="{{ route('users.index') }}" class="mb-6 bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <label for="nameFilter" class="block text-sm font-medium text-gray-700 mb-2">
                Filter by Name:
            </label>
            <div class="flex flex-col sm:flex-row gap-3">
                <select
                    id="nameFilter"
                    name="name_filter"
                    onchange="this.form.submit()"
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-700 font-medium transition-all duration-200"
                >
                    <option value="">All Users</option>
                    @foreach(\App\Models\User::pluck('name') as $name)
                        <option value="{{ $name }}" {{ request('name_filter') == $name ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
                <a
                    href="{{ route('users.index') }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors text-center"
                >
                    Reset
                </a>
            </div>
        </form>

        <!-- Users Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-x-auto border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider w-56">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider w-56">Username</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider w-44">Phone</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider w-72">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider w-40">Final Amount</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider w-96">Products</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $user->username }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $user->phone }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $user->email }}</td>
                            <td class="px-6 py-4 font-semibold text-green-600">₹{{ number_format($user->final_amount, 2) }}</td>
                            <td class="px-6 py-4">
                                <ul class="space-y-1 text-sm text-gray-600">
                                    @forelse($user->products as $product)
                                        <li class="flex justify-between items-center">
                                            <span class="font-medium">{{ $product->product_name }}</span>
                                            <span class="text-gray-500">₹{{ $product->price }} × {{ $product->quantity }}</span>
                                            <span class="text-xs text-gray-400 ml-2">({{ ucfirst($product->type) }}, {{ $product->discount }}% off)</span>
                                        </li>
                                    @empty
                                        <li class="text-gray-500 italic">No products</li>
                                    @endforelse
                                </ul>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($users instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="px-6 py-3 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                {{ $users->links() }}
            </div>
        @endif
    </div>

</body>
</html>
