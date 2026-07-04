<?php

namespace App\Livewire\Site;

use App\Support\MockSchools;
use Livewire\Attributes\Computed;
use Livewire\Component;

/**
 * Tela dos pais: filtros de nível de ensino, bairro e série para
 * consulta de vagas em unidades escolares. Dados 100% mockados
 * (App\Support\MockSchools) — sem integração com backend/API.
 *
 * Filtragem em tempo real: os selects usam wire:model.live, então qualquer
 * alteração recalcula "resultados" automaticamente, sem reload e sem exigir
 * um botão de busca explícito.
 */
class SchoolSearch extends Component
{
    public string $nivel = '';

    public string $bairro = '';

    public string $serie = '';

    /**
     * Reseta todos os filtros para o estado inicial (lista completa).
     */
    public function limparFiltros(): void
    {
        $this->reset('nivel', 'bairro', 'serie');
    }

    /**
     * Resultados filtrados, recalculados a cada alteração de filtro.
     * Extraído como computed property para não duplicar a chamada de
     * MockSchools::search() entre o cabeçalho de contagem e a listagem.
     */
    #[Computed]
    public function resultados()
    {
        return MockSchools::search($this->nivel, $this->bairro, $this->serie);
    }

    public function render()
    {
        return view('livewire.site.school-search', [
            'niveis' => MockSchools::niveis(),
            'bairros' => MockSchools::bairros(),
            'series' => MockSchools::series(),
            // Reaproveitado do dashboard administrativo para alimentar o hero.
            'totais' => MockSchools::totals(),
        ])->layout('layouts.site', ['pageTitle' => 'Consultar Vagas']);
    }
}
