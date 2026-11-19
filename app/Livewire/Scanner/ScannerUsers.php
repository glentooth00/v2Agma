<?php

namespace App\Livewire\Scanner;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layout.app')]
class ScannerUsers extends Component
{

    public bool $showScannerUserModal = false;

    public string $firstname = '';
    public string $middlename = '';
    public string $lastname = '';

    public string $status = 'active';
    public string $assignedStation = '';

    public string $username = '';
    public string $password = '';
    public function render()
    {
        return view('livewire.scanner.scanner-users');
    }

    public function openScannerUserModal(): void
    {
        $this->resetValidation();

        $this->reset([
            'firstname',
            'middlename',
            'lastname',
            'assignedStation',
            'username',
            'password',
        ]);

        $this->status = 'active';
        $this->showScannerUserModal = true;
    }

    public function closeScannerUserModal(): void
    {
        $this->showScannerUserModal = false;
        $this->resetValidation();
    }

    public function saveScannerUser(): void
    {
        $this->validate([
            'firstname' => 'required|string|max:100',
            'middlename' => 'nullable|string|max:100',
            'lastname' => 'required|string|max:100',
            'status' => 'required|in:active,disabled',
            'assignedStation' => 'required|string|max:50',
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:8',
        ]);

        // We will connect the database creation here
        // after confirming your existing User model structure.
    }
}
