<form action="{{ $user->id ? route('users.update', $user->id) : route('users.store') }}" method="POST">
	@csrf

	@if($user->id)
	@method("PUT")
	@endif

	<div class="mb-3">
		<x-label for="name" :value="__('Name')" />
		<x-input type="text" name="name" id="name" :placeholder="__('Name')" :value="old('name', $user->name)" autofocus />
		<x-invalid error="name" />
	</div>

	<div class="mb-3">
		<x-label for="email" :value="__('Email')" />
		<x-input type="email" name="email" id="email" :placeholder="__('Email')" :value="old('email', $user->email)" />
		<x-invalid error="email" />
	</div>
	<div class="mb-3">
		<x-label for="Phone Number" :value="__('Phone Number')" />
		<x-input type="number" pattern="\d*" name="phone" id="phone" :placeholder="__('Phone Number')" :value="old('Phone', $user->phone)" />
	</div>
	<div class="mb-3">
		<x-label for="Role" :value="__('Role')" />
		<select class="form-select" id="role" name="role">
			<option value="1" {{ old('role') == '1' ? 'selected' : '' }}>Admin</option>
			<option value="2" {{ old('role') == '2' ? 'selected' : '' }}>Pegawai</option>
		</select>
	</div>

	@if($user->id)
	<div class="mb-3">
		<x-label for="password" :value="__('Password')" />
		<x-input type="password" name="password" id="password" :placeholder="__('Password')" />
		<x-invalid error="password">
			<small>{{ __('Empty if not change.') }}</small>
		</x-invalid>
	</div>

	<div class="mb-3">
		<x-label for="password_confirmation" :value="__('Password confirmation')" />
		<x-input type="password" name="password_confirmation" id="password_confirmation" :placeholder="__('Password confirmation')" />
		<x-invalid error="password_confirmation">
			<small>{{ __('Empty if not change.') }}</small>
		</x-invalid>
	</div>
	@else
	<div class="mb-3">
		<x-label for="password" :value="__('Password')" />
		<x-input type="password" name="password" id="password" :placeholder="__('Password')" />
		<x-invalid error="password" />
	</div>

	<div class="mb-3">
		<x-label for="password_confirmation" :value="__('Password confirmation')" />
		<x-input type="password" name="password_confirmation" id="password_confirmation" :placeholder="__('Password confirmation')" />
		<x-invalid error="password_confirmation" />
	</div>
	@endif

	<div class="text-end">
		<x-button type="submit" class="btn btn-primary" :value="$user->id ? __('Update') : __('Create')" />
	</div>


</form>