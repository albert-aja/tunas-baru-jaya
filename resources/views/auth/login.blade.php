<!DOCTYPE html>
<html>
	<head>
        <title>{{ config('app.name') }}</title>
        @include('layouts.favicon')
        @include('layouts.description')
        @include('layouts.style')
	</head>

	<body class="">
		<div class="se-pre-con"></div>
		<div class="login-box">
			<div class="login-box-body">
				<p class="login-box-msg" style="font-size: 20px !important; font-weight: 900 !important;">
					{{ config('app.name') }}<br>
					{{ __('Login') }}
				</p>
				<form id="FormLogin" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group has-feedback">
						<input placeholder="Username" id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autofocus>
						<span class="fa fa-user form-control-feedback"></span>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
					<div class="form-group has-feedback">
						<input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        <span class="fa fa-key form-control-feedback"></span>                        
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button type="submit" class="btn btn-primary btn-block" style="margin-bottom: 10px;">
                        {{ __('Login') }}
                    </button>                    
				</form>
			</div>
			<div class="login-footer">
				<center>
					Copyright &copy; 2020 <br>{{ config('app.name') }}<br>All rights reserved.
				</center>
			</div>
		</div>
        @include('layouts.script')
		@if (count($errors) > 0)
			<script type="text/javascript"> 
				swal("Gagal", "Kombinasi Usernama dan Password tidak ditemukan.", "error"); 
			</script>
		@endif
	</body>
</html>
