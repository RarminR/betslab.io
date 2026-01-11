<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.tips.show', $tip) }}" class="text-slate-400 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-white">Editează: {{ $tip->title }}</h2>
        </div>
    </x-slot>

    <form action="{{ route('admin.tips.update', $tip) }}" method="POST" x-data="tipForm()" class="max-w-4xl">
        @csrf
        @method('PUT')

        <!-- Basic Info -->
        <div class="bg-slate-800/50 rounded-xl border border-slate-700 p-6 mb-6">
            <h3 class="text-lg font-semibold text-white mb-4">Informații Generale</h3>
            
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-slate-400 text-sm mb-2">Titlu</label>
                    <input type="text" name="title" value="{{ old('title', $tip->title) }}" required
                        class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white focus:border-amber-400 focus:outline-none">
                </div>

                <div>
                    <label class="block text-slate-400 text-sm mb-2">Sport</label>
                    <select name="sport" required class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white focus:border-amber-400 focus:outline-none">
                        @foreach(['Football', 'Tennis', 'Basketball', 'Hockey', 'Volleyball', 'Handball', 'MMA', 'Esports'] as $sport)
                        <option value="{{ $sport }}" {{ $tip->sport === $sport ? 'selected' : '' }}>{{ $sport }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-slate-400 text-sm mb-2">Miză (1-10)</label>
                    <input type="number" name="stake" value="{{ old('stake', $tip->stake) }}" min="1" max="10" required
                        class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white focus:border-amber-400 focus:outline-none">
                </div>

                <div>
                    <label class="block text-slate-400 text-sm mb-2">Canal Telegram</label>
                    <select name="channel_type" required class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white focus:border-amber-400 focus:outline-none">
                        <option value="vip" {{ old('channel_type', $tip->channel_type) === 'vip' ? 'selected' : '' }}>🔒 VIP (Abonați)</option>
                        <option value="free" {{ old('channel_type', $tip->channel_type) === 'free' ? 'selected' : '' }}>🆓 FREE (Gratuit)</option>
                    </select>
                    @error('channel_type') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-slate-400 text-sm mb-2">Analiză (opțional - doar pentru VIP)</label>
                <textarea name="analysis" rows="3" class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white focus:border-amber-400 focus:outline-none" placeholder="Adaugă analiza ta detaliată aici...">{{ old('analysis', $tip->analysis) }}</textarea>
                @error('analysis') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Selections -->
        <div class="bg-slate-800/50 rounded-xl border border-slate-700 p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-white">Selecții</h3>
                <button type="button" @click="addSelection()" class="px-3 py-1 bg-amber-400/20 text-amber-400 rounded-lg text-sm hover:bg-amber-400/30 transition">
                    + Adaugă Selecție
                </button>
            </div>

            <div class="space-y-4">
                <template x-for="(selection, index) in selections" :key="index">
                    <div class="bg-slate-700/50 rounded-lg p-4 relative">
                        <button type="button" @click="removeSelection(index)" x-show="selections.length > 1"
                            class="absolute top-2 right-2 text-red-400 hover:text-red-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>

                        <input type="hidden" :name="'selections[' + index + '][id]'" x-model="selection.id">

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-slate-400 text-sm mb-2">Eveniment</label>
                                <input type="text" :name="'selections[' + index + '][event_name]'" x-model="selection.event_name" required
                                    class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white focus:border-amber-400 focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-slate-400 text-sm mb-2">Ligă</label>
                                <input type="text" :name="'selections[' + index + '][league]'" x-model="selection.league"
                                    class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white focus:border-amber-400 focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-slate-400 text-sm mb-2">Data și Ora</label>
                                <input type="datetime-local" :name="'selections[' + index + '][event_date]'" x-model="selection.event_date" required
                                    class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white focus:border-amber-400 focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-slate-400 text-sm mb-2">Cotă</label>
                                <input type="number" step="0.01" min="1" :name="'selections[' + index + '][odds]'" x-model="selection.odds" required
                                    class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white focus:border-amber-400 focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-slate-400 text-sm mb-2">Pronostic</label>
                                <input type="text" :name="'selections[' + index + '][prediction]'" x-model="selection.prediction" required
                                    class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white focus:border-amber-400 focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-slate-400 text-sm mb-2">Rezultat</label>
                                <select :name="'selections[' + index + '][result]'" x-model="selection.result"
                                    class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white focus:border-amber-400 focus:outline-none">
                                    <option value="pending">În așteptare</option>
                                    <option value="won">Câștigat</option>
                                    <option value="lost">Pierdut</option>
                                    <option value="void">Anulat</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Submit -->
        <div class="flex items-center justify-end space-x-4">
            <a href="{{ route('admin.tips.show', $tip) }}" class="px-6 py-3 bg-slate-700 text-white rounded-lg hover:bg-slate-600 transition">
                Anulează
            </a>
            <button type="submit" class="px-6 py-3 bg-amber-400 text-slate-900 rounded-lg font-semibold hover:bg-amber-500 transition">
                Salvează Modificările
            </button>
        </div>
    </form>

    <script>
        function tipForm() {
            return {
                selections: @json($tip->selections->map(function($s) {
                    return [
                        'id' => $s->id,
                        'event_name' => $s->event_name,
                        'league' => $s->league,
                        'event_date' => $s->event_date->format('Y-m-d\TH:i'),
                        'odds' => $s->odds,
                        'prediction' => $s->prediction,
                        'result' => $s->result,
                    ];
                })),
                addSelection() {
                    this.selections.push({ id: null, event_name: '', league: '', event_date: '', odds: '', prediction: '', result: 'pending' });
                },
                removeSelection(index) {
                    this.selections.splice(index, 1);
                }
            }
        }
    </script>
</x-admin-layout>

