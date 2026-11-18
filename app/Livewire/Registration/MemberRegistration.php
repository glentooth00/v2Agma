<?php

namespace App\Livewire\Registration;

use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layout.registration', ['title' => 'Member Registration'])]
class MemberRegistration extends Component
{
    public string $classification = '';

    public string $firstname = '';
    public string $middlename = '';
    public string $lastname = '';

    public ?string $selectedAccountNumber = null;
    public ?int $selectedMemberId = null;
    public ?string $dateOfBirth = null;

    public bool $searchPerformed = false;

    public function searchMember(): void
    {
        $this->searchPerformed = true;
        $this->selectedMemberId = null;
        $this->selectedAccountNumber = null;
    }

    public function clearSearch(): void
    {
        $this->reset([
            'firstname',
            'middlename',
            'lastname',
            'searchPerformed',
        ]);
    }

    public function updatedClassification(): void
    {
        $this->reset([
            'firstname',
            'middlename',
            'lastname',
            'dateOfBirth',
            'selectedMemberId',
            'selectedAccountNumber',
            'searchPerformed',
        ]);
    }

    public function selectMember($id): void
    {
        $member = Member::findOrFail($id);

        $type = strtoupper(trim($member->member_type ?? ''));

        if (
            $this->classification === 'residential'
            && !in_array($type, ['SINGLE', 'JOINT'])
        ) {
            return;
        }

        if (
            $this->classification === 'juridical_public_building'
            && $type !== 'JURIDICAL'
        ) {
            return;
        }

        $this->selectedMemberId = $member->id;
        $this->selectedAccountNumber = null;

        $this->dispatch('member-selected');
    }

    public function render()
    {
        $members = collect();
        $accounts = collect();

        $firstname = trim($this->firstname);
        $middlename = trim($this->middlename);
        $lastname = trim($this->lastname);

        if ($this->searchPerformed) {

            $query = Member::query();

            // Account classification
            if ($this->classification === 'residential') {
                $query->whereIn('member_type', ['SINGLE', 'JOINT']);
            } elseif ($this->classification === 'juridical_public_building') {
                $query->where('member_type', 'JURIDICAL');
            } else {
                $query->whereRaw('1 = 0');
            }

            // Name search
            if ($firstname !== '') {
                $query->where('firstname', 'LIKE', "%{$firstname}%");
            }

            if ($this->classification === 'residential') {
                if ($middlename !== '') {
                    $query->where('middlename', 'LIKE', "%{$middlename}%");
                }

                if ($lastname !== '') {
                    $query->where('lastname', 'LIKE', "%{$lastname}%");
                }
            }

            // Do not return records if no name was entered
            if (
                $firstname !== ''
                || ($this->classification === 'residential'
                    && ($middlename !== '' || $lastname !== ''))
            ) {
                $members = $query
                    ->orderBy('firstname')
                    ->limit(10)
                    ->get();
            }
        }

        $selectedMember = $this->selectedMemberId
            ? Member::find($this->selectedMemberId)
            : null;

        if ($selectedMember) {
            $accounts = DB::table('customer_details')
                ->where('tracking_number', $selectedMember->membership_id)
                ->orderBy('c_id')
                ->get();
        }

        $accountOptions = $accounts
            ->pluck('c_id', 'c_id')
            ->map(fn ($id) => (string) $id)
            ->toArray();

        return view('livewire.registration.member-registration', [
            'members' => $members,
            'selectedMember' => $selectedMember,
            'accounts' => $accounts,
            'accountOptions' => $accountOptions,
            'searchPerformed' => $this->searchPerformed,
        ]);
    }
}
