<?php

namespace App\Livewire\Registration;

use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\AgmaRegistration;

#[Layout('components.layout.registration', ['title' => 'Member Registration'])]
class MemberRegistration extends Component
{
    public string $classification = '';

    public string $firstname = '';
    public string $middlename = '';
    public string $lastname = '';
    public string $district = '';
    public string $brgy = '';
    public string $street = '';
    public string $municipality = '';
    public ?string $selectedAccountNumber = null;
    public ?int $selectedMemberId = null;
    public ?string $dateOfBirth = null;
    public bool $consentAccepted = false;
    public bool $registrationSaved = false;
    public string $membership_id = '';

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
            'district',
            'brgy',
            'street',
            'municipality',
        ]);
    }

    public function selectMember($id): void
    {
        // Check whether the selected record exists.
        $member = Member::where('membership_id', $id)->first();

        if (!$member) {
            logger()->error('AGMA: Selected member not found', [
                'received_id' => $id,
            ]);

            $this->addError('selectedMemberId', 'Member record not found.');
            return;
        }

        $this->selectedMemberId = (int) $member->id;
        $this->selectedAccountNumber = null;

        $this->district = $member->district ?? '';
        $this->brgy = $member->brgy ?? '';
        $this->street = $member->street ?? '';
        $this->municipality = $member->municipality ?? '';

        $this->resetErrorBag('selectedMemberId');

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

    public function submitRegistration()
    {
        $this->validate([
            'classification' => 'required|in:residential,juridical_public_building',
            'selectedMemberId' => 'required',
            'selectedAccountNumber' => 'required',
            'dateOfBirth' => 'required|date',
            'district' => 'nullable|string|max:255',
            'brgy' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'municipality' => 'nullable|string|max:255',
            'consentAccepted' => 'accepted',
        ]);

        $member = Member::findOrFail($this->selectedMemberId);

        // Verify that the selected account belongs to this member.
        $accountExists = DB::table('customer_details')
            ->where('tracking_number', $member->membership_id)
            ->where('c_id', $this->selectedAccountNumber)
            ->exists();

        if (!$accountExists) {
            $this->addError(
                'selectedAccountNumber',
                'The selected account does not belong to this member.'
            );

            return;
        }


        AgmaRegistration::create([
            'registration_type' => 'online_registration',
            'classification' => $this->classification,
            'membership_id' => $member->membership_id,
            'account_number' => $this->selectedAccountNumber,
            'district' => $this->district,
            'brgy' => $this->brgy,
            'street' => $this->street,
            'municipality' => $this->municipality,
            'date_of_birth' => $this->dateOfBirth,
            'status' => 'pending',
        ]);

        $this->registrationSaved = true;
    }
}
