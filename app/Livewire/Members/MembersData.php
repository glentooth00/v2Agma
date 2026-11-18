<?php

namespace App\Livewire\Members;

use App\Models\Member;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layout.app')]
class MembersData extends Component
{
    use WithPagination;

    public $firstname = '';
    public $middlename = '';
    public $lastname = '';
    public $membership_status = '';

    public function updating($property): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $members = Member::query()
            ->when(trim($this->firstname), function ($query) {
                $value = trim($this->firstname);

                $query->where('firstname', 'LIKE', '%' . $value . '%');
            })
            ->when(trim($this->middlename), function ($query) {
                $value = trim($this->middlename);

                $query->where('middlename', 'LIKE', '%' . $value . '%');
            })
            ->when(trim($this->lastname), function ($query) {
                $value = trim($this->lastname);

                $query->where('lastname', 'LIKE', '%' . $value . '%');
            })
            ->when($this->membership_status, function ($query) {
                $query->where('membership_status', $this->membership_status);
            })
            ->orderBy('lastname')
            ->orderBy('firstname')
            ->paginate(10);

        return view('livewire.members.index', [
            'title' => 'Members',
            'members' => $members,
        ]);
    }

    public function clearSearch(): void
    {
        $this->reset(['firstname', 'middlename', 'lastname']);
        $this->resetPage();
    }
}
