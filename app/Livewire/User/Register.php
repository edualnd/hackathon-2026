<?php

namespace App\Livewire\User;

use App\Models\Escola;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $name = '';
    public $email = '';
    public $cpf = '';
    public $password = '';
    public $password_confirmation = '';
    public $role = '';
    public $escola_id = null;
    public $escolas = [
        [ 'id' => 0, 'nome' => ""]
    ];
    public function mount(){
        $this->escolas = Escola::select('id', 'nome')->get();
    }

    public function register()
    {
        if ($this->role == 'demanda'){$this->escola_id = null;}
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'cpf' => 'required|unique:users,cpf',
            'password' => 'required|confirmed|min:6',
            'role' => 'required',
            'escola_id' => 'required_unless:role,demanda|nullable|exists:escolas,id'
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'password' => Hash::make($this->password),
            'role' => $this->role,
            'escola_id' => $this->escola_id,
        ]);

        
        $this->reset(['name','email','cpf', 'password','password_confirmation', 'role', 'escola_id' ]);
        $this->escola_id = null;

    }

    public function render()
    {
        return view('livewire.user.register');
    }
}
