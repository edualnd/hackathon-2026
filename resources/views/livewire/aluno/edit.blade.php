<div class="mx-auto max-w-5xl px-6 py-8 sm:px-10">
    <div class="mb-6">
        <p class="font-body text-[11px] font-semibold uppercase tracking-wide text-seduc-neutral-500">Alunos</p>
        <h1 class="font-heading text-2xl font-bold text-text-on-surface">Editar Cadastro</h1>
        <p class="mt-1 font-body text-sm text-seduc-neutral-600">{{ $aluno->nome }} — atualize os dados ou a situação do cadastro.</p>
    </div>

    <x-site.aluno-form :vagas="$vagas" :show-status="true" />
</div>
