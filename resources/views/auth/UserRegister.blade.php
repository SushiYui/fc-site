@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form action="{{ route('users.store') }}" method="POST">
    @csrf

    <label>名前: <input type="text" name="name" value="{{ old('name') }}"></label>
    @error('name') <p style="color:red">{{ $message }}</p> @enderror

    <label>メール: <input type="email" name="email" value="{{ old('email') }}"></label>
    @error('email') <p style="color:red">{{ $message }}</p> @enderror

    <label>パスワード: <input type="password" name="password"></label>
    @error('password') <p style="color:red">{{ $message }}</p> @enderror

    <label>郵便番号: <input type="text" name="postal_code" value="{{ old('postal_code') }}"></label>
    @error('postal_code') <p style="color:red">{{ $message }}</p> @enderror

    <label>市区町村: <input type="text" name="city" value="{{ old('city') }}"></label>
    @error('city') <p style="color:red">{{ $message }}</p> @enderror

    <label>町名・番地: <input type="text" name="street" value="{{ old('street') }}"></label>
    @error('street') <p style="color:red">{{ $message }}</p> @enderror

    <label>建物名: <input type="text" name="building" value="{{ old('building') }}"></label>
    @error('building') <p style="color:red">{{ $message }}</p> @enderror

    <label>電話番号: <input type="text" name="phone_number" value="{{ old('phone_number') }}"></label>
    @error('phone_number') <p style="color:red">{{ $message }}</p> @enderror

    <button type="submit">登録</button>
</form>
