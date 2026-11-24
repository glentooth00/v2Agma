<?php

namespace App\Livewire\Registration;

use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\AgmaRegistration;
use Livewire\WithFileUploads;
use Barryvdh\DomPDF\Facade\Pdf;
use Devxisas\QrStudio\Facades\QrCode;


#[Layout('components.layout.registration', ['title' => 'Member Registration'])]
class MemberRegistration extends Component
{

    use WithFileUploads;
    
    public string $classification = '';
    public $validId;
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
    public $qrCode = '';
    public $registeredMember = [];
    public $registeredAccountNumber = null;
    public bool $searchPerformed = false;
    public bool $alreadyRegistered = false;
    public ?array $existingRegistration = null;


    public function searchMember(): void
    {
        $this->resetValidation();

        // Reset previous search selection.
        $this->searchPerformed = false;
        $this->selectedMemberId = null;
        $this->selectedAccountNumber = null;
        $this->alreadyRegistered = false;
        $this->existingRegistration = null;

        // Validate based on classification.
        if ($this->classification === 'juridical_public_building') {
            $this->validate([
                'firstname' => 'required|string|max:255',
            ]);
        } else {
            $this->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
            ]);
        }

        // Execute the search only after validation.
        $this->searchPerformed = true;
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
        $this->resetErrorBag();

        // Find the selected member.
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

        // Reset previous duplicate-check result.
        $this->alreadyRegistered = false;
        $this->existingRegistration = null;

        // Check whether this membership ID is already registered.
        $registration = AgmaRegistration::where(
            'membership_id',
            $member->membership_id
        )->latest('id')->first();

        if ($registration) {
            $this->alreadyRegistered = true;

            $this->existingRegistration = [
                'account_number' => $registration->account_number,
                'status' => $registration->status,
                'registration_type' => $registration->registration_type,
                'created_at' => $registration->created_at?->format('M d, Y h:i A'),
            ];

            // Do not proceed to the registration form.
            return;
        }

        // Only proceed if the member is not registered.
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
            'validId' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $member = Member::findOrFail($this->selectedMemberId);

        // Prevent duplicate registration.
        $existingRegistration = AgmaRegistration::where(
            'membership_id',
            $member->membership_id
        )->exists();

        if ($existingRegistration) {
            $this->alreadyRegistered = true;

            $this->addError(
                'selectedMemberId',
                'This member is already registered for the AGMA.'
            );

            return;
        }

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

        // Save the uploaded ID file.
        $validIdPath = $this->validId->store('valid-ids', 'public');

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
            'valid_id_path' => $validIdPath,
        ]);

        // Generate QR code using membership ID.
        $qr = QrCode::size(250)
        ->margin(0)
        ->generate($member->membership_id);

        $this->qrCode = (string) $qr;

        $this->registrationSaved = true;
    }

    public function downloadMemberCard()
    {
        // Retrieve the selected member.
        $member = Member::findOrFail($this->selectedMemberId);

        // Generate the QR code if it is not already available.
        $qrCode = $this->qrCode;

        if (empty($qrCode)) {
            $qr = QrCode::size(250)
                ->margin(0)
                ->generate($member->membership_id);

            $qrCode = (string) $qr;
        }

        // Generate the member ID PDF.
        $pdf = Pdf::loadView('pdf.member-card', [
            'qrCode' => $qrCode,
            'member' => $member,
            'accountNumber' => $this->selectedAccountNumber,
        ]);

        // CR80 ID card dimensions: 85.6mm × 54mm.
        $pdf->setPaper([0, 0, 242.65, 153.07]);

        $output = $pdf->output();

        return response()->streamDownload(function () use ($output) {
            echo $output;
        }, 'AGMA-Member-ID-' . $member->membership_id . '.pdf', [
            'Content-Type' => 'application/pdf',
        ]);
    }

    public function registerAnotherAccount(): void
    {
        $this->reset([
            'classification',
            'firstname',
            'middlename',
            'lastname',
            'selectedAccountNumber',
            'searchPerformed',
            'dateOfBirth',
            'selectedMemberId',
            'district',
            'brgy',
            'street',
            'municipality',
            'consentAccepted',
            'registrationSaved',
            'validId',
            'qrCode',
        ]);

        $this->resetValidation();

        $this->dispatch('registration-reset');
    }

    
}
