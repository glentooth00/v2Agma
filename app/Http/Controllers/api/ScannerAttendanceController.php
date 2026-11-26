<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AgmaAttendance;
use App\Models\AgmaRegistration;
use App\Models\ScannerUser;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScannerAttendanceController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'agma_registration_id' => [
                'required',
                'integer',
                'exists:agma_registrations,id',
            ],
            'device_id' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        /** @var ScannerUser $scanner */
        $scanner = $request->user();

        $registration = AgmaRegistration::findOrFail(
            $validated['agma_registration_id']
        );

        // Prevent duplicate attendance.
        $existingAttendance = AgmaAttendance::where(
            'agma_registration_id',
            $registration->id
        )->first();

        if ($existingAttendance) {
            return response()->json([
                'success' => false,
                'already_attended' => true,
                'message' => 'This member has already checked in.',
                'data' => [
                    'attended_at' => $existingAttendance->attended_at,
                ],
            ], 409);
        }

        try {
            $attendance = AgmaAttendance::create([
                'agma_registration_id' => $registration->id,
                'attendance_type' => 'registered_online',
                'scanner_user_id' => $scanner->id,
                'device_id' => $validated['device_id'] ?? null,
            ]);
        } catch (QueryException $exception) {
            // Handle simultaneous submissions protected by the unique key.
            $existingAttendance = AgmaAttendance::where(
                'agma_registration_id',
                $registration->id
            )->first();

            if (!$existingAttendance) {
                throw $exception;
            }

            return response()->json([
                'success' => false,
                'already_attended' => true,
                'message' => 'This member has already checked in.',
                'data' => [
                    'attended_at' => $existingAttendance->attended_at,
                ],
            ], 409);
        }

        return response()->json([
            'success' => true,
            'already_attended' => false,
            'message' => 'Attendance confirmed successfully.',
            'data' => [
                'attendance_id' => $attendance->id,
                'agma_registration_id' => $attendance->agma_registration_id,
                'attendance_type' => $attendance->attendance_type,
                'attended_at' => $attendance->attended_at,
            ],
        ], 201);
    }
}
