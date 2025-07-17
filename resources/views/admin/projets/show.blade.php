<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-3 rounded-xl shadow-lg">
                💰
            </div>
            <h2 class="text-3xl font-bold text-indigo-900">Détail du projet communautaire</h2>
        </div>
        <p class="text-gray-600 mt-1">Gestion et modération du projet soumis</p>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 bg-white rounded-2xl shadow-lg border border-gray-100">
        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $projet->title }}</h3>

        <p class="text-gray-700 mb-6 whitespace-pre-line">{{ $projet->description }}</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-green-50 p-4 rounded-lg text-center">
                <div class="text-xs font-medium text-green-700 mb-1">Objectif financier</div>
                <div class="text-xl font-bold text-green-900">{{ number_format($projet->objectif, 0, ',', ' ') }} CFA</div>
            </div>
            <div class="bg-blue-50 p-4 rounded-lg text-center">
                <div class="text-xs font-medium text-blue-700 mb-1">Soumis par</div>
                <div class="text-lg font-semibold text-blue-900">{{ $projet->user->name ?? 'Anonyme' }}</div>
            </div>
            <div class="bg-yellow-50 p-4 rounded-lg text-center">
                <div class="text-xs font-medium text-yellow-700 mb-1">Date de création</div>
                <div class="text-lg font-semibold text-yellow-900">{{ $projet->created_at->format('d/m/Y H:i') }}</div>
            </div>
        </div>

        <div class="mb-6">
            <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                {{ $projet->approuve ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-yellow-100 text-yellow-800 border border-yellow-200' }}">
                {{ $projet->approuve ? '✅ Approuvé' : '⏳ En attente' }}
            </span>
        </div>

        <div class="flex flex-wrap gap-4">
            @if(!$projet->approuve)
                <form action="{{ route('admin.projets.approuver', $projet) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-sm transition duration-200" onclick="return confirm('Approuver ce projet ?')">
                        <i class="bi bi-check-lg mr-2"></i> Approuver
                    </button>
                </form>
            @endif

            <a href="{{ route('admin.projets.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg shadow-sm transition duration-200">
                <i class="bi bi-arrow-left mr-2"></i> Retour à la liste
            </a>
            <a href="{{ route('admin.projets.edit', $projet) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg shadow-sm transition duration-200">
    ✏️ Modifier
</a>

            <form action="{{ route('admin.projets.destroy', $projet) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ce projet ? Cette action est irréversible.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow-sm transition duration-200">
                    <i class="bi bi-trash mr-2"></i> Supprimer
                </button>
            </form>
        </div>
    </div>
    <div class="mt-6">
    <h3 class="text-lg font-bold text-gray-800 mb-2">Contributeurs</h3>

    @if($projet->contributions->count() > 0)
        <ul class="space-y-1 text-sm">
            @foreach($projet->contributions as $contribution)
                <li>
                    ✅ {{ $contribution->user->name ?? 'Utilisateur supprimé' }} —
                    <strong>{{ number_format($contribution->montant, 0, ',', ' ') }} FCFA</strong>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-500 italic">Aucune contribution pour le moment.</p>
    @endif
</div>

</x-app-layout>
