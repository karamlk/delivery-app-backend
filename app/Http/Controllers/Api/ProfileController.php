<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\UserPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function getProfile(Request $request)
    {
        $user =  $request->user();

        return new ProfileResource($user);
    }

    public function getProfilePhotos()
    {
        $photos = UserPhoto::all();

        $photos = $photos->reject(function ($photo) {
            return $photo->id == 11;
        });

        return response()->json([
            'photos' => $photos->map(function ($photo) {
                return [
                    'id' => $photo->id,
                    'profile_photo' => file_exists(public_path($photo->photo_url))
                        ? asset($photo->photo_url)
                        : 'https://placehold.co/150x150?text=profile_photo',
                ];
            })
        ]);
    }

    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            'photo_id' => 'required|integer|exists:user_photos,id',
        ]);

        $user = $request->user();

        $photo = UserPhoto::findOrFail($request->photo_id);

        $user->profile_photo = $photo->photo_url;
        $user->save();

        return new ProfileResource($user);
    }

    // public function updatePassword(Request $request)
    // {
    //     $validated = $request->validate([
    //         'current_password' => 'required',
    //         'new_password' => 'required|confirmed|min:8',
    //     ]);

    //     $user = $request->user();

    //     if (!Hash::check($validated['current_password'], $user->password)) {
    //         return response()->json(['message' => 'The current password is incorrect.'], 400);
    //     }

    //     $user->password = Hash::make($validated['new_password']);
    //     $user->save();

    //     return response()->json(['message' => 'Password updated successfully.']);
    // }


    // public function updateFirstName(Request $request)
    // {
    //     $validated = $request->validate([
    //         'first_name' => 'required|string|max:255',
    //     ]);

    //     $user = $request->user();

    //     $user->first_name = $validated['first_name'];

    //     $user->save();

    //     return response()->json(['message' => 'First name updated successfully.']);
    // }

    // public function updateLastName(Request $request)
    // {
    //     $validated = $request->validate([
    //         'last_name' => 'required|string|max:255',
    //     ]);

    //     $user = $request->user();

    //     $user->last_name = $validated['last_name'];

    //     $user->save();

    //     return response()->json(['message' => 'Last name updated successfully.']);
    // }

    // public function updateEmail(Request $request)
    // {
    //     $validated = $request->validate([
    //         'email' => 'required|email|unique:users,email,' . auth('sanctum')->id(),
    //     ]);

    //     $user = $request->user();

    //     if (!$user) {
    //         return response()->json(['message' => 'User not authenticated.'], 401);  // Unauthorized
    //     }

    //     $user->email = $validated['email'];

    //     $user->save();

    //     return response()->json(['message' => 'Email updated successfully.']);
    // }

    // public function updatePhoneNumber(Request $request)
    // {
    //     $validated = $request->validate([
    //         'phone_number' => 'required|digits:10|unique:users,phone_number,' . auth('sanctum')->id(),
    //     ]);

    //     $user = $request->user();

    //     if (!$user) {
    //         return response()->json(['message' => 'User not authenticated.'], 401);
    //     }

    //     $user->phone_number = $validated['phone_number'];

    //     $user->save();

    //     return response()->json(['message' => 'Phone number updated successfully.']);
    // }

    // public function updateLocation(Request $request)
    // {
    //     $validated = $request->validate([
    //         'location' => 'nullable|string|max:255',
    //     ]);

    //     $user = $request->user();

    //     if (!$user) {
    //         return response()->json(['message' => 'User not authenticated.'], 401);
    //     }

    //     $user->location = $validated['location'];

    //     $user->save();

    //     return response()->json(['message' => 'Location updated successfully.']);
    // }

    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'phone_number' => 'sometimes|digits:10|unique:users,phone_number,' . $user->id,
            'location' => 'nullable|string|max:255',
            'current_password' => 'required_with:new_password',
            'new_password'     => 'required_with:current_password|confirmed|min:8',
        ]);

        if (isset($validated['new_password'])) {
            if (! Hash::check($validated['current_password'], $user->password)) {
                return response()->json(['message' => 'The current password is incorrect.'], 400);
            }
            $user->password = Hash::make($validated['new_password']);
        }

        unset($validated['current_password'], $validated['new_password']);

        $user->update($validated);

        return response()->json(['message' => 'Profile updated successfully.']);
    }
}
