@extends('layouts.app')
@section('content')
<div class="bg-no-repeat bg-cover py-0 m-auto h-screen w-full absolute opacity-80">
</div>
<div class="relative min-h-screen flex flex-col sm:justify-center items-center">
    <div class="relative sm:max-w-sm w-full">
        <div class="relative w-full rounded-lg px-6 py-4 bg-main-fund shadow-md">
            <div class="py-2">
                <h1 for="" class="block mt-3 text-lg  text-center font-semibold">¿Olvidó su contraseña?</h1>
                <p class="block mt-3 text-sm text-justify">No te preocupes, estamos aquí para ayudarte a recuperar el acceso a tu cuenta. Por favor, sigue los pasos a continuación:</p>
            </div>
            <br>
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="email" name="email" class="block py-3 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-yellow appearance-none dark:text-black dark:border-yellow dark:focus:border-yellow focus:outline-none focus:ring-0 focus:border-yellow peer" placeholder=" " :value="old('email')" id="email" required />
                        <label for="email" value="{{ __('Email') }}" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-500 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-gray-500 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Correo electrónico</label>
                    </div>
                    <div class="relative z-0 w-full m-3">
                        @error('email')
                        <span class="invalid-feedback text-red text-center" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mt-16">
                        <button type="submit" class="bg-main w-full py-3 rounded-xl text-white font-bold shadow-xl hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:bg-secondary">
                            Restablecer
                        </button>
                    </div>
                    <div class="mt-5 mb-7 flex">
                        <div class="w-full text-center font-bold">
                            <a class="underline text-sm hover:a-secondary hover:text-secondary" href="{{ route('login') }}">
                                ¿Recordaste tu contraseña?
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection