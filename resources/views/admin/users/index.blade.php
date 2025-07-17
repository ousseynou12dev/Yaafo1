<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">👥 Gestion des utilisateurs</h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto">
        <div class="mb-4">
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ session('error') }}</div>
            @endif

            <form method="GET" action="{{ route('admin.users.index') }}" class="flex justify-end mb-4">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="🔍 Rechercher par nom ou email"
                    class="border rounded-l px-4 py-2 w-64 shadow-sm" />
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r hover:bg-blue-700">
                    Rechercher
                </button>
            </form>
        </div>

        <div class="bg-white shadow rounded p-4">
            <table class="w-full table-auto border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">Nom</th>
                        <th class="p-2 border">Email</th>
                        <th class="p-2 border">Rôle</th>
                        <th class="p-2 border">Statut</th>
                        <th class="p-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="p-2 border">{{ $user->id }}</td>
                            <td class="p-2 border">{{ $user->name }}</td>
                            <td class="p-2 border">{{ $user->email }}</td>
                            <td class="p-2 border">{{ ucfirst($user->role) }}</td>
                            <td class="p-2 border">
                                <span class="text-xs px-2 py-1 rounded
                                    {{ $user->status == 'actif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td class="p-2 border space-x-1">
                                <form method="POST" action="{{ route('admin.users.toggle', $user->id) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="text-white text-sm px-3 py-1 rounded
                                        {{ $user->status === 'actif' ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-green-600 hover:bg-green-700' }}">
                                        {{ $user->status === 'actif' ? 'Désactiver' : 'Activer' }}
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="inline" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1 rounded">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center text-gray-500">Aucun utilisateur trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $users->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
