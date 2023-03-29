<?php

namespace App\Http\Controllers\Cabinet;

use Throwable;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\ImageUploader;
use Illuminate\Validation\Rules;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Auth\ProfileRequest;

class ProfileController extends Controller
{
    /**
     * @param Request $request
     *
     * @return View
     */
    public function index(Request $request): View
    {
        return view('cabinet.profile.index')
            ->with('user', $request->user());
    }

    /**
     * @param ProfileRequest $request
     *
     * @return JsonResponse
     */
    public function update(ProfileRequest $request): JsonResponse
    {
        $request->user()->update([
            'name'        => $request['name'],
            'slug'        => $request['slug'],
            'description' => clean($request['description'], 'youtube')
        ]);

        session()->flash('flash', ['message' => 'Информация изменена']);

        return response()->json(['redirect' => route('cabinet.profile.index')]);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function password(Request $request): JsonResponse
    {
        $this->validate($request, [
            'password' => ['required', 'string', 'confirmed', Rules\Password::min(6)]
        ]);

        $request
            ->user()
            ->update(['password' => Hash::make($request['password'])]);

        session()->flash('flash', ['message' => 'Пароль обновлён']);

        return response()->json(['redirect' => route('cabinet.profile.index')]);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function avatar(Request $request): JsonResponse
    {
        try {
            $image = ImageUploader::from('file')
                ->autoOrient()
                ->thumbnail(300, 300, 'top')
                ->setPartialsDir(false)
                ->saveWithoutGeneralSave('avatars');

            $user = $request->user();

            if (!$user->isDefaultAvatar()) {
                Storage::delete($user->avatar);
            }

            $user->update(['avatar' => $image->getPath()]);

            session()->flash('flash', ['message' => 'Аватарка обновлена']);

            return response()->json(['result' => true]);
        } catch (Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
}