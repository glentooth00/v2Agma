<?php

namespace App\Livewire\Registration;

use App\Models\Member;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layout.registration', ['title' => 'Member Registration'])]
class MemberRegistration extends Component
{
    public $classification = '';

    public $firstname = '';
    public $middlename = '';
    public $lastname = '';

    public $selectedMemberId = null;

    public function render()
    {
        $members = collect();

        $hasSearch = trim($this->firstname) !== ''
            || (
                $this->classification === 'residential'
                && (
                    trim($this->middlename) !== ''
                    || trim($this->lastname) !== ''
                )
            );

        if ($hasSearch) {
            $members = Member::query()
                ->when(
                    $this->classification === 'residential',
                    fn ($query) => $query->whereIn('member_type', ['SINGLE', 'JOINT'])
                )
                ->when(
                    $this->classification === 'juridical_public_building',
                    fn ($query) => $query->where('member_type', 'JURIDICAL')
                )
                ->when(
                    trim($this->firstname) !== '',
                    fn ($query) => $query->where(
                        'firstname',
                        'like',
                        '%' . trim($this->firstname) . '%'
                    )
                )
                ->when(
                    $this->classification === 'residential' && trim($this->middlename) !== '',
                    fn ($query) => $query->where(
                        'middlename',
                        'like',
                        '%' . trim($this->middlename) . '%'
                    )
                )
                ->when(
                    $this->classification === 'residential' && trim($this->lastname) !== '',
                    fn ($query) => $query->where(
                        'lastname',
                        'like',
                        '%' . trim($this->lastname) . '%'
                    )
                )
                ->orderBy('firstname')
                ->limit(10)
                ->get();
        }

        $selectedMember = $this->selectedMemberId
            ? Member::find($this->selectedMemberId)
            : null;

        return view('livewire.registration.member-registration', [
            'members' => $members,
            'selectedMember' => $selectedMember,
        ]);
    }

    public function updatedClassification(): void
    {
        $this->reset([
            'firstname',
            'middlename',
            'lastname',
            'selectedMemberId',
        ]);
    }

    public function selectMember($id): void
    {
        $member = Member::findOrFail($id);

        if (
            $this->classification === 'residential'
            && !in_array(strtoupper($member->member_type), ['SINGLE', 'JOINT'])
        ) {
            return;
        }

        if (
            $this->classification === 'juridical_public_building'
            && strtoupper($member->member_type) !== 'JURIDICAL'
        ) {
            return;
        }

        $this->selectedMemberId = $member->id;

        $this->dispatch('member-selected');
    }
}
