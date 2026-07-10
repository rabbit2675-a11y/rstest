<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex items-center justify-between">
                        <h1 class="text-xl font-semibold text-gray-800">Benutzerliste aktuell</h1>
                        <span class="text-sm text-gray-500">{{ $users->count() }} Benutzer</span>
                    </div>

                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table id="users-table" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        <button type="button" class="flex items-center gap-1 hover:text-gray-900" data-sort="id">
                                            ID
                                            <span class="text-gray-400">↕</span>
                                        </button>
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        <button type="button" class="flex items-center gap-1 hover:text-gray-900" data-sort="name">
                                            Name
                                            <span class="text-gray-400">↕</span>
                                        </button>
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        <button type="button" class="flex items-center gap-1 hover:text-gray-900" data-sort="email">
                                            E-Mail
                                            <span class="text-gray-400">↕</span>
                                        </button>
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        <button type="button" class="flex items-center gap-1 hover:text-gray-900" data-sort="created_at">
                                            Erstellt am
                                            <span class="text-gray-400">↕</span>
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($users as $user)
                                    <tr class="transition-colors duration-150 hover:bg-gray-50">
                                        <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-700">{{ $user->id }}</td>
                                        <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-700">{{ $user->name }}</td>
                                        <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-700">{{ $user->email }}</td>
                                        <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-700">{{ $user->created_at->format('d.m.Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Wenn Sie Paginate() im Controller verwendet haben: -->
                    <!-- {{ $users->links() }} -->
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const table = document.getElementById('users-table');
            if (!table) return;

            const tbody = table.querySelector('tbody');
            const headers = table.querySelectorAll('th button[data-sort]');

            headers.forEach((button) => {
                button.addEventListener('click', () => {
                    const key = button.getAttribute('data-sort');
                    const direction = button.dataset.direction === 'asc' ? 'desc' : 'asc';

                    headers.forEach((btn) => delete btn.dataset.direction);
                    button.dataset.direction = direction;

                    const rows = Array.from(tbody.querySelectorAll('tr'));
                    const columnIndex = key === 'name' ? 1 : key === 'email' ? 2 : key === 'created_at' ? 3 : 0;

                    rows.sort((a, b) => {
                        const aValue = a.children[columnIndex].textContent.trim();
                        const bValue = b.children[columnIndex].textContent.trim();

                        if (key === 'id') {
                            return direction === 'asc'
                                ? Number(aValue) - Number(bValue)
                                : Number(bValue) - Number(aValue);
                        }

                        return direction === 'asc'
                            ? aValue.localeCompare(bValue, undefined, { sensitivity: 'base' })
                            : bValue.localeCompare(aValue, undefined, { sensitivity: 'base' });
                    });

                    rows.forEach((row) => tbody.appendChild(row));
                });
            });
        });
    </script>
</x-app-layout>
