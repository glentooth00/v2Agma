<?php

namespace App\Livewire\Scanner;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\ScannerUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


#[Layout('components.layout.app')]
class ScannerUsers extends Component
{
    public bool $showEditScannerUserModal = false;
    public bool $showScannerUserModal = false;
    public string $firstname = '';
    public string $middlename = '';
    public string $lastname = '';
    public string $status = 'active';
    public string $assignedStation = '';
    public string $username = '';
    public string $password = '';
    public ?int $editingScannerUserId = null;
    public string $editStatus = 'active';
    public string $newPassword = '';
    public string $editFirstname = '';
    public string $editMiddlename = '';
    public string $editLastname = '';
    public string $editUsername = '';
    public string $editAssignedStation = '';

    public function render()
    {
        $scannerUsers = ScannerUser::latest()->get();

        $totalUsers = ScannerUser::count();

        $activeUsers = ScannerUser::where('status', 'active')->count();

        $disabledUsers = ScannerUser::where('status', 'disabled')->count();

        $totalStations = ScannerUser::distinct('assigned_station')
            ->count('assigned_station');

        return view('livewire.scanner.scanner-users', [
            'scannerUsers' => $scannerUsers,
            'totalUsers' => $totalUsers,
            'activeUsers' => $activeUsers,
            'disabledUsers' => $disabledUsers,
            'totalStations' => $totalStations,
        ]);
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
        $validated = $this->validate([
            'firstname' => 'required|string|max:100',
            'middlename' => 'nullable|string|max:100',
            'lastname' => 'required|string|max:100',
            'status' => 'required|in:active,disabled',
            'assignedStation' => 'required|string|max:50',
            'username' => [
                'required',
                'string',
                'max:50',
                Rule::unique('scanner_users', 'username'),
            ],
            'password' => 'required|string|min:8',
        ]);

        ScannerUser::create([
            'firstname' => $validated['firstname'],
            'middlename' => $validated['middlename'] ?: null,
            'lastname' => $validated['lastname'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'assigned_station' => $validated['assignedStation'],
            'status' => $validated['status'],
        ]);

        $this->showScannerUserModal = false;

        $this->reset([
            'firstname',
            'middlename',
            'lastname',
            'assignedStation',
            'username',
            'password',
        ]);

        $this->status = 'active';

        $this->resetValidation();

        // BlatUI Sonner success notification
        $this->dispatch('scanner-user-created');
    }

    public function editScannerUser(int $id): void
    {
        $user = ScannerUser::findOrFail($id);

        $this->editingScannerUserId = $user->id;
        $this->showEditScannerUserModal = true;
        $this->editFirstname = $user->firstname;
        $this->editMiddlename = $user->middlename ?? '';
        $this->editLastname = $user->lastname;
        $this->editUsername = $user->username;
        $this->editAssignedStation = $user->assigned_station;
        $this->editStatus = $user->status;

        $this->newPassword = '';

        $this->resetValidation();
    }

    public function updateScannerUser(): void
    {
        $user = ScannerUser::findOrFail($this->editingScannerUserId);

        $validated = $this->validate([
            'editFirstname' => 'required|string|max:100',
            'editMiddlename' => 'nullable|string|max:100',
            'editLastname' => 'required|string|max:100',

            'editUsername' => [
                'required',
                'string',
                'max:50',
                Rule::unique('scanner_users', 'username')->ignore($user->id),
            ],

            'editAssignedStation' => 'required|string|max:50',
            'editStatus' => 'required|in:active,disabled',
            'newPassword' => 'nullable|string|min:8',
        ]);

        $user->firstname = $validated['editFirstname'];
        $user->middlename = $validated['editMiddlename'] ?: null;
        $user->lastname = $validated['editLastname'];
        $user->username = $validated['editUsername'];
        $user->assigned_station = $validated['editAssignedStation'];
        $user->status = $validated['editStatus'];

        if (!empty($validated['newPassword'])) {
            $user->password = Hash::make($validated['newPassword']);
        }

        $user->save();

                $this->reset([
            'editingScannerUserId',
            'editFirstname',
            'editMiddlename',
            'editLastname',
            'editUsername',
            'editAssignedStation',
            'newPassword',
        ]);

        $this->showEditScannerUserModal = false;

        $this->editStatus = 'active';

        $this->resetValidation();

        // Close the BlatUI dialog
        $this->dispatch('close-dialog-edit-scanner-user');

        // Show success toast
        $this->dispatch('scanner-user-updated');

        }

}
