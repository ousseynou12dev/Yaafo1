<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-indigo-900 flex items-center gap-3">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-3 rounded-xl shadow-lg">
                        💰
                    </div>
                    Projets communautaires - Gestion admin
                </h2>
                <p class="text-gray-600 mt-2">Modérez et approuvez les projets soumis par la communauté</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="bg-white rounded-lg px-4 py-2 shadow-sm border">
                    <span class="text-sm font-medium text-gray-600">Total:</span>
                    <span class="text-lg font-bold text-indigo-600">{{ $projets->count() }}</span>
                </div>
                <div class="bg-yellow-50 rounded-lg px-4 py-2 shadow-sm border border-yellow-200">
                    <span class="text-sm font-medium text-yellow-600">En attente:</span>
                    <span class="text-lg font-bold text-yellow-700">{{ $projets->where('approuve', false)->count() }}</span>
                </div>
                <div class="bg-green-50 rounded-lg px-4 py-2 shadow-sm border border-green-200">
                    <span class="text-sm font-medium text-green-600">Approuvés:</span>
                    <span class="text-lg font-bold text-green-700">{{ $projets->where('approuve', true)->count() }}</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-6 rounded-lg bg-green-100 p-4 text-green-800 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-6">
            @forelse ($projets as $projet)
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="p-6 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">{{ $projet->title }}</h3>
                            <p class="text-gray-700 mt-1">{{ \Illuminate\Support\Str::limit($projet->description, 150) }}</p>
                            <p class="mt-2 text-sm text-gray-600">
                                Proposé par : <strong>{{ $projet->user->name ?? 'Anonyme' }}</strong> —
                                Objectif : <strong>{{ number_format($projet->objectif, 0, ',', ' ') }} CFA</strong>
                            </p>
                        </div>
                        <div class="flex items-center gap-4 flex-wrap">
                            @if($projet->approuve)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-200">
                                    ✅ Approuvé
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                    ⏳ En attente
                                </span>
                            @endif

                            <a href="{{ route('admin.projets.show', $projet) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-sm transition duration-200">
                                <i class="bi bi-eye mr-2"></i> Voir
                            </a>

                            @if(!$projet->approuve)
                                <form action="{{ route('admin.projets.approuver', $projet) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-sm transition duration-200" onclick="return confirm('Approuver ce projet ?')">
                                        <i class="bi bi-check-lg mr-2"></i> Approuver
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('admin.projets.destroy', $projet) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ce projet ? Cette action est irréversible.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow-sm transition duration-200">
                                    <i class="bi bi-trash mr-2"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <div class="text-6xl mb-4">💡</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Aucun projet soumis pour le moment</h3>
                    <p class="text-gray-600 mb-6">Les projets soumis par la communauté apparaîtront ici.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
