    <div class="col-12 mt-5">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </div>
    <div class="col-8 mt-2">
        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="mb-2">
                <label for="update_password_current_password" class="form-label">{{__('Senha Atual')}}</label>
                <input class="form-control mt-1 block w-full" id="update_password_current_password" name="current_password" type="password" autocomplete="current-password">
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />

            </div>

            <div class="mb-2">
                <label for="update_password_password" class="form-label">{{__('Nova Senha')}}</label>
                <input class="form-control mt-1 block w-full" id="update_password_password" name="password" type="password"  autocomplete="new-password">
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />

            </div>

            <div class="mb-2">
                <label for="update_password_password_confirmation" class="form-label">{{__('Confirme a senha')}}</label>
                <input class="form-control mt-1 block w-full" id="update_password_password_confirmation" name="password_confirmation" type="password"  autocomplete="new-password">
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <button class="btn btn-primary mt-1" id="btn" type="submit">Salvar</button>

                @if (session('status') === 'password-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>
