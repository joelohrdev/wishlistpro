<?php

declare(strict_types=1);

namespace App\Livewire\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;

final class Profile extends Component
{
    public string $name = '';

    public string $email = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name; // @phpstan-ignore property.nonObject
        $this->email = Auth::user()->email; // @phpstan-ignore property.nonObject
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id), // @phpstan-ignore property.nonObject
            ],
        ]);

        $user->fill($validated); // @phpstan-ignore method.nonObject

        if ($user->isDirty('email')) { // @codeCoverageIgnore, @phpstan-ignore method.nonObject
            $user->email_verified_at = null; // @codeCoverageIgnore, @phpstan-ignore property.nonObject
        }

        $user->save(); // @phpstan-ignore method.nonObject

        $this->dispatch('profile-updated', name: $user->name); // @phpstan-ignore property.nonObject
    }

    /**
     * Send an email verification notification to the current user.
     *
     * @codeCoverageIgnore
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) { // @phpstan-ignore method.nonObject
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification(); // @phpstan-ignore method.nonObject

        Session::flash('status', 'verification-link-sent');
    }
}
