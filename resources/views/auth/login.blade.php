<x-guest-layout>
    <div class="flex flex-col justify-center h-full min-h-screen">
        <form wire:submit.prevent="login" class="space-y-4">
            @csrf

            <div>
                <x-input-label for="email" value="Email Address" />
                <x-text-input id="email" type="email" name="email" wire:model.defer="email" required autofocus />
                <x-input-error for="email" />
            </div>

            <div>
                <x-input-label for="password" value="Password" />
                <x-text-input id="password" type="password" name="password" wire:model.defer="password" required />
                <x-input-error for="password" />
            </div>

            <div class="flex items-center justify-between">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500"
                        wire:model.defer="remember">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>

                <a class="text-sm text-green-600 hover:underline" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            </div>

            <div>
                <x-primary-button class="w-full bg-green-400 hover:bg-green-500">
                    Sign In
                </x-primary-button>
            </div>

            <div class="text-center text-gray-500 text-sm">
                or
            </div>

            <div>
                <a href="#" class="block w-full text-center bg-white border rounded shadow-sm py-2">
                    Login with Google
                </a>
            </div>

            <div>
                <a href="{{ route('register') }}"
                class="block w-full text-center bg-green-500 text-white font-semibold rounded-md shadow-sm py-2 hover:bg-green-600 transition">
                    Register
                </a>
            </div>

            {{-- PASTIKAN INI ADA --}}
            <div class="text-center text-sm text-gray-600 mt-6">
                Don’t have an account yet?
                <a href="{{ route('register') }}" class="text-green-700 font-semibold hover:underline">
                    Sign Up
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
