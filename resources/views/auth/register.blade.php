<x-guest-layout>
<h1 style="text-align: center; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; font-size: 20px;">REGISTER NEW ACCOUNT</h1>
<br>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <!-- Name -->
        <div>
            <x-input-label for="fname" :value="__('First name')" />
            <x-text-input id="fname" class="block mt-1 w-full" type="text" name="fname" :value="old('fname')" required autofocus autocomplete="off" />
            <x-input-error :messages="$errors->get('fname')" class="mt-2" />
        </div>
        <br>
        <div>
            <x-input-label for="mname" :value="__('Middle name')" />
            <x-text-input id="mname" class="block mt-1 w-full" type="text" name="mname" :value="old('mname')" required autofocus autocomplete="off" />
            <x-input-error :messages="$errors->get('mname')" class="mt-2" />
        </div>
        <br>
        <div>
            <x-input-label for="lname" :value="__('Last name')" />
            <x-text-input id="lname" class="block mt-1 w-full" type="text" name="lname" :value="old('lname')" required autofocus autocomplete="off" />
            <x-input-error :messages="$errors->get('lname')" class="mt-2" />
        </div>


        <!-- insert default picture -->
        <input type="hidden" class="image" name="image" value="photo_defaults.png">

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="off" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="off" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
