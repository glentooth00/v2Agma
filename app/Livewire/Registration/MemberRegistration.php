<?php

namespace App\Livewire\Registration;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layout.registration', ['title' => 'Member Registration'])]
class MemberRegistration extends Component
{
    public function render()
    {
        return view('livewire.registration.member-registration');
    }
}
