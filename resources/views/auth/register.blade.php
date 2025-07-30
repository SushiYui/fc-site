<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('名前')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('メールアドレス')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- 郵便番号 -->
        <div class="mt-4">
            <x-input-label for="postal_code" :value="__('郵便番号')" />
            <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" :value="old('postal_code')" required />
            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
        </div>

        <!-- 市区町村（自動入力される）-->
        <div class="mt-4">
            <x-input-label for="city" :value="__('都道府県・市区町村')" />
            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required />
            <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>

        {{-- 番地 --}}
        <div class="mt-4">
            <x-input-label for="street" :value="__('番地')" />
            <x-text-input id="street" class="block mt-1 w-full" type="text" name="street" :value="old('street')" required />
            <x-input-error :messages="$errors->get('street')" class="mt-2" />
        </div>

        {{-- 建物名 --}}
        <div class="mt-4">
            <x-input-label for="building" :value="__('建物名 (任意)')" />
            <x-text-input id="building" class="block mt-1 w-full" type="text" name="building" :value="old('building')" />
            <x-input-error :messages="$errors->get('building')" class="mt-2" />
        </div>

        {{-- 電話番号 --}}
        <div class="mt-4">
            <x-input-label for="phone_number" :value="__('電話番号')" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        {{-- ファンクラブ会員 --}}
        <div class="mt-4">
            <label class="flex items-center">
                <input type="checkbox" name="funclub_member" value="1" {{ old('funclub_member') ? 'checked' : '' }} class="mr-2">
                <span>{{ __('I am a fan club member') }}</span>
            </label>
            <x-input-error :messages="$errors->get('funclub_member')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('パスワード')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('パスワード確認')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const postalInput = document.getElementById('postal_code');
                    const cityInput = document.getElementById('city');

                    postalInput.addEventListener('keyup', function () {
                        const postalCode = postalInput.value.trim();
                        if (!postalCode.match(/^\d{7}$/)) {
                            return;
                        }

                        fetch(`https://zipcloud.ibsnet.co.jp/api/search?zipcode=${postalCode}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.results && data.results.length > 0) {
                                    const address = data.results[0];
                                    cityInput.value = address.address1 + address.address2 + address.address3;
                                } else {
                                    alert('住所が見つかりませんでした');
                                }
                            })
                            .catch(error => {
                                console.error('通信エラー:', error);
                            });
                    });
                });
            </script>
            @endpush

    </form>
</x-guest-layout>
