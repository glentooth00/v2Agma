<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ScannerUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ScannerAuthController extends Controller
{
    /**
     * Scanner personnel login.
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string'],
        ]);

        $scanner = ScannerUser::where(
            'username',
            $validated['username']
        )->first();

        if (!$scanner) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid username or password.',
            ], 401);
        }

        if ($scanner->status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'Your scanner account is disabled. Please contact the AGMA ONE Administrator.',
            ], 403);
        }

        if (!Hash::check(
            $validated['password'],
            $scanner->password
        )) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid username or password.',
            ], 401);
        }

        // Revoke previous sessions for this scanner account.
        $scanner->tokens()->delete();

        // Create a new Sanctum token.
        $token = $scanner->createToken('scanner-device')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
            'token' => $token,
            'user' => $this->scannerData($scanner),
        ]);
    }

    /**
     * Get authenticated scanner information.
     */
    public function me(Request $request)
    {
        $scanner = $request->user();

        return response()->json([
            'success' => true,
            'message' => 'Scanner account retrieved successfully.',
            'user' => $this->scannerData($scanner),
        ]);
    }

    /**
     * Logout scanner personnel.
     */
    public function logout(Request $request)
    {
        $scanner = $request->user();

        $scanner->currentAccessToken()?->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout successful.',
        ]);
    }

    /**
     * Format scanner user information.
     */
    private function scannerData(ScannerUser $scanner): array
    {
        return [
            'id' => $scanner->id,
            'firstname' => $scanner->firstname,
            'middlename' => $scanner->middlename,
            'lastname' => $scanner->lastname,
            'full_name' => trim(
                $scanner->firstname . ' ' .
                ($scanner->middlename ? $scanner->middlename . ' ' : '') .
                $scanner->lastname
            ),
            'username' => $scanner->username,
            'assigned_station' => $scanner->assigned_station,
            'status' => $scanner->status,
        ];
    }
}
