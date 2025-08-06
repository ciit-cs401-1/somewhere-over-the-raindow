<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold">Register</h1>
        <p class="text-gray-600">Create your account to get started.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="relative mb-4">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="fas fa-user text-gray-400"></i>
            </span>
            <x-text-input id="name" class="pl-10 block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="relative mt-4">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="fas fa-envelope text-gray-400"></i>
            </span>
            <x-text-input id="email" class="pl-10 block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="relative mt-4">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="fas fa-lock text-gray-400"></i>
            </span>
            <x-text-input id="password" class="pl-10 block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            placeholder="Password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="relative mt-4">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="fas fa-lock text-gray-400"></i>
            </span>
            <x-text-input id="password_confirmation" class="pl-10 block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="Confirm Password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Already have an account? <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Log in</a>
            </p>
        </div>
    </form>
</x-guest-layout>
