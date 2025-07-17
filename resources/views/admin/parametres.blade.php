<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">⚙️ Paramètres administrateur</h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-10 px-4 space-y-10">
        <!-- Bloc informations de compte -->
        <div class="bg-white rounded shadow p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">🧑‍💼 Informations du compte</h3>

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" name="name" value="{{ auth()->user()->name }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ auth()->user()->email }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    💾 Mettre à jour
                </button>
            </form>
        </div>

        <!-- Bloc changement de mot de passe -->
        <div class="bg-white rounded shadow p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">🔒 Changer de mot de passe</h3>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Mot de passe actuel</label>
                    <input type="password" name="current_password"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required />
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                    <input type="password" name="password"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required />
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Confirmer le nouveau mot de passe</label>
                    <input type="password" name="password_confirmation"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required />
                </div>

                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    🔐 Modifier le mot de passe
                </button>
            </form>
        </div>

        <!-- Bloc paramètres fictifs -->
        <div class="bg-white rounded shadow p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">⚙️ Paramètres du site</h3>

            <p class="text-sm text-gray-600">Exemple : seuil de modération automatique, activer les commentaires...</p>

            <div class="mt-4 flex space-x-4">
                <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded hover:bg-gray-200">
                    🛠 Gérer les catégories
                </button>
                <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded hover:bg-gray-200">
                    👁‍🗨 Mots interdits
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
