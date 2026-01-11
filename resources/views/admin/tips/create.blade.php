<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.tips.index') }}" class="text-slate-400 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-white">Adaugă Pronostic</h2>
        </div>
    </x-slot>

    <form action="{{ route('admin.tips.store') }}" method="POST" x-data="tipForm()" class="max-w-4xl">
        @csrf

        <!-- Basic Info -->
        <div class="bg-slate-800/50 rounded-xl border border-slate-700 p-6 mb-6">
            <h3 class="text-lg font-semibold text-white mb-4">Informații Generale</h3>
            
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-slate-400 text-sm mb-2">Titlu</label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                        class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white focus:border-amber-400 focus:outline-none"
                        placeholder="ex: Bilet Weekend Fotbal">
                    @error('title') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-slate-400 text-sm mb-2">Sport</label>
                    <select name="sport" required class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white focus:border-amber-400 focus:outline-none">
                        <option value="Football">Fotbal</option>
                        <option value="Tennis">Tenis</option>
                        <option value="Basketball">Baschet</option>
                        <option value="Hockey">Hochei</option>
                        <option value="Volleyball">Volei</option>
                        <option value="Handball">Handbal</option>
                        <option value="MMA">MMA/Boxing</option>
                        <option value="Esports">Esports</option>
                    </select>
                    @error('sport') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-slate-400 text-sm mb-2">Miză (1-10)</label>
                    <input type="number" name="stake" value="{{ old('stake', 5) }}" min="1" max="10" required
                        class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white focus:border-amber-400 focus:outline-none">
                    @error('stake') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-slate-400 text-sm mb-2">Canal Telegram</label>
                    <select name="channel_type" required class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white focus:border-amber-400 focus:outline-none">
                        <option value="vip" {{ old('channel_type', 'vip') === 'vip' ? 'selected' : '' }}>🔒 VIP (Abonați)</option>
                        <option value="free" {{ old('channel_type') === 'free' ? 'selected' : '' }}>🆓 FREE (Gratuit)</option>
                    </select>
                    @error('channel_type') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-slate-400 text-sm mb-2">Analiză (opțional - doar pentru VIP)</label>
                <textarea name="analysis" rows="3" class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white focus:border-amber-400 focus:outline-none" placeholder="Adaugă analiza ta detaliată aici...">{{ old('analysis') }}</textarea>
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

            <div class="space-y-4" id="selections">
                <template x-for="(selection, index) in selections" :key="index">
                    <div class="bg-slate-700/50 rounded-lg p-4 relative">
                        <button type="button" @click="removeSelection(index)" x-show="selections.length > 1"
                            class="absolute top-2 right-2 text-red-400 hover:text-red-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-slate-400 text-sm mb-2">Eveniment</label>
                                <input type="text" :name="'selections[' + index + '][event_name]'" x-model="selection.event_name" required
                                    class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white focus:border-amber-400 focus:outline-none"
                                    placeholder="ex: Real Madrid vs Barcelona">
                            </div>

                            <div>
                                <label class="block text-slate-400 text-sm mb-2">Ligă</label>
                                <input type="text" :name="'selections[' + index + '][league]'" x-model="selection.league"
                                    class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white focus:border-amber-400 focus:outline-none"
                                    placeholder="ex: La Liga">
                            </div>

                            <div>
                                <label class="block text-slate-400 text-sm mb-2">Data și Ora</label>
                                <input type="datetime-local" :name="'selections[' + index + '][event_date]'" x-model="selection.event_date" required
                                    class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white focus:border-amber-400 focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-slate-400 text-sm mb-2">Cotă</label>
                                <input type="number" step="0.01" min="1" :name="'selections[' + index + '][odds]'" x-model="selection.odds" required
                                    class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white focus:border-amber-400 focus:outline-none"
                                    placeholder="1.85">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-slate-400 text-sm mb-2">Pronostic</label>
                                <input type="text" :name="'selections[' + index + '][prediction]'" x-model="selection.prediction" required
                                    class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-2 text-white focus:border-amber-400 focus:outline-none"
                                    placeholder="ex: Over 2.5 Goals">
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Total Odds Preview -->
            <div class="mt-4 pt-4 border-t border-slate-700 flex items-center justify-between">
                <span class="text-slate-400">Cotă Totală Estimată:</span>
                <span class="text-2xl font-bold text-amber-400" x-text="calculateTotalOdds()"></span>
            </div>
        </div>

        <!-- Submit -->
        <div class="flex items-center justify-end space-x-4">
            <a href="{{ route('admin.tips.index') }}" class="px-6 py-3 bg-slate-700 text-white rounded-lg hover:bg-slate-600 transition">
                Anulează
            </a>
            <button type="submit" class="px-6 py-3 bg-amber-400 text-slate-900 rounded-lg font-semibold hover:bg-amber-500 transition">
                Salvează Pronostic
            </button>
        </div>
    </form>

    <script>
        function tipForm() {
            return {
                selections: [
                    { event_name: '', league: '', event_date: '', odds: '', prediction: '' }
                ],
                addSelection() {
                    this.selections.push({ event_name: '', league: '', event_date: '', odds: '', prediction: '' });
                },
                removeSelection(index) {
                    this.selections.splice(index, 1);
                },
                calculateTotalOdds() {
                    let total = 1;
                    this.selections.forEach(s => {
                        if (s.odds && parseFloat(s.odds) > 0) {
                            total *= parseFloat(s.odds);
                        }
                    });
                    return total.toFixed(2);
                }
            }
        }
    </script>
</x-admin-layout>

