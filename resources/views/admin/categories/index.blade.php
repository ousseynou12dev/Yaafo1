<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">📂 Gestion des catégories</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10 px-4 space-y-6">
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded">{{ session('success') }}</div>
        @endif

        <!-- Formulaire d’ajout -->
        <form method="POST" action="{{ route('admin.categories.store') }}" class="flex space-x-2">
            @csrf
            <input type="text" name="name" placeholder="Nom de la catégorie" class="border rounded px-4 py-2 w-full">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Ajouter</button>
        </form>

        <!-- Liste des catégories -->
        <div class="bg-white rounded shadow p-4">
            <h3 class="text-lg font-semibold mb-4">📃 Liste des catégories</h3>

            <table class="w-full table-auto border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2">Nom</th>
                        <th class="border p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td class="border p-2">
                                <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="name" value="{{ $category->name }}"
                                        class="w-full border-none focus:outline-none">
                                </form>
                            </td>
                            <td class="border p-2 text-right">
                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                       onsubmit="return confirm('Supprimer cette catégorie ?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
