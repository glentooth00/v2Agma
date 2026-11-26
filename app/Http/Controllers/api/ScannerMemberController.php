<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AgmaRegistration;
use Illuminate\Http\JsonResponse;

class ScannerMemberController extends Controller
{
    /**
     * Find a registered member using the membership ID
     * read from the QR code.
     */
    public function show(string $membershipId): JsonResponse
    {
        // Find the AGMA registration using the QR membership ID.
        $registration = AgmaRegistration::with('member')
            ->where('membership_id', $membershipId)
            ->latest('id')
            ->first();

        // Registration not found.
        if (!$registration) {
            return response()->json([
                'success' => false,
                'message' => 'No AGMA registration found for this membership ID.',
            ], 404);
        }

        // Retrieve the corresponding member record.
        $member = $registration->member;

        if (!$member) {
            return response()->json([
                'success' => false,
                'message' => 'Member information could not be found.',
            ], 404);
        }

        // Combine the member's name.
        $fullName = collect([
            $member->firstname,
            $member->middlename,
            $member->lastname,
            $member->suffixname,
        ])
            ->filter(fn ($value) => filled($value))
            ->implode(' ');

        // Combine the registration address.
        $completeAddress = collect([
            $registration->street,
            $registration->brgy,
            $registration->district,
            $registration->municipality,
        ])
            ->filter(fn ($value) => filled($value))
            ->implode(', ');

        // Generate the public URL for the submitted valid ID.
        $validIdUrl = $registration->valid_id_path
            ? asset('storage/' . $registration->valid_id_path)
            : null;

        return response()->json([
            'success' => true,
            'message' => 'Member registration found.',

            'data' => [
                'agma_registration_id' => $registration->id,
                'membership_id' => $registration->membership_id,
                'full_name' => $fullName,
                'account_number' => $registration->account_number,
                'complete_address' => $completeAddress,

                'valid_id' => [
                    'available' => !empty($registration->valid_id_path),
                    'path' => $registration->valid_id_path,
                    'url' => $validIdUrl,
                ],
            ],
        ]);
    }
}
