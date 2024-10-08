    <div class="col-12 mt-5">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </div>
    <div class="col-8">
        <form method="post" action="{{ route('profile.destroy') }}"  onsubmit="return confirm('Certeza?');">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>
            <div class="mt-6">
                <label for="password" class="form-label">{{__('Senha')}}</label>
                <input class="form-control mt-1 block w-full" id="password" name="password" type="password" value=""  required placeholder="{{ __('Password') }}">
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6">
                <button class="btn btn-primary mt-1" id="btn" type="submit">Deletar Conta</button>
            </div>
        </form>
    </div>
