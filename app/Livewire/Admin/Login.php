<?php

namespace App\Livewire\Admin;

use Livewire\Component;

/**
 * Login da área administrativa.
 * Não há autenticação real — apenas simula a navegação, conforme
 * especificado (o painel administrativo ainda não está integrado
 * ao sistema de contas do Jetstream).
 */
class Login extends Component
{
    public string $email = '';

    public string $senha = '';

    protected array $rules = [
        'email' => 'required|email',
        'senha' => 'required|min:4',
    ];

    public function entrar()
    {
        $this->validate();

        return redirect()->route('admin.dashboard');
    }

    public function render()
    {
        return view('livewire.admin.login', [
            'pageTitle' => 'Acesso Administrativo',
        ]);
    }
}
