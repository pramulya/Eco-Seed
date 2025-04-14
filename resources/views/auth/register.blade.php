<form wire:submit.prevent="register" class="space-y-4">
    <div>
        <x-input-label for="name" value="Username" />
        <x-text-input id="name" type="text" name="name" wire:model.defer="name" required autofocus />
        <x-input-error for="name" />
    </div>

    <div>
        <x-input-label for="email" value="Email Address" />
        <x-text-input id="email" type="email" name="email" wire:model.defer="email" required />
        <x-input-error for="email" />
    </div>

    <div>
        <x-input-label for="password" value="Password" />
        <x-text-input id="password" type="password" name="password" wire:model.defer="password" required />
        <x-input-error for="password" />
    </div>

    <div>
        <x-primary-button class="w-full bg-green-400 hover:bg-green-500">
            Sign Up
        </x-primary-button>
    </div>

    <div class="text-center text-gray-500 text-sm">
        or
    </div>

    <div>
        <a href="{{ route('login') }}" class="block w-full text-center bg-white border rounded shadow-sm py-2">
            Login with Google
        </a>
    </div>

    <div class="text-center text-xs text-gray-600 mt-4">
        Already have an account? <a href="{{ route('login') }}" class="text-green-700 font-semibold">Sign In</a>
    </div>
</form>
