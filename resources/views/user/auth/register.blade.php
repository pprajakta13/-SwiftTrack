<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Create Account | SwiftTrack</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="min-h-screen bg-slate-950 flex items-center justify-center p-6">

<div class="w-full max-w-5xl bg-white rounded-3xl overflow-hidden shadow-2xl grid md:grid-cols-2">


    <!-- LEFT SIDE -->

    <div class="hidden md:flex bg-gradient-to-br from-slate-950 via-blue-950 to-blue-600 text-white p-12 flex-col justify-center">

        <div class="text-3xl font-black">

            🚚 Swift<span class="text-blue-300">Track</span>

        </div>


        <h1 class="text-5xl font-black mt-10 leading-tight">

            Start tracking
            <br>
            smarter.

        </h1>


        <p class="mt-5 text-blue-100 leading-7">

            Create an account and manage your courier
            parcels from one simple place.

        </p>


        <div class="mt-8 space-y-3 text-blue-50">

            <p>
                ✓ Book parcels online
            </p>

            <p>
                ✓ Get a unique tracking number
            </p>

            <p>
                ✓ Follow every status update
            </p>

        </div>

    </div>


    <!-- RIGHT SIDE -->

    <div class="p-8 md:p-12">

        <h2 class="text-3xl font-black text-slate-900">

            Create account 🚚

        </h2>


        <p class="text-slate-500 mt-2 mb-7">

            Join SwiftTrack in less than a minute.

        </p>


        <!-- ERRORS -->

        @if($errors->any())

            <div class="mb-5 rounded-xl bg-red-50 border border-red-200 p-4 text-sm text-red-700">

                @foreach($errors->all() as $error)

                    <div>
                        {{ $error }}
                    </div>

                @endforeach

            </div>

        @endif


        <!-- REGISTER FORM -->

        <form
            method="POST"
            action="{{ route('user.register.submit') }}"
            class="space-y-4"
        >

            @csrf


            <!-- NAME -->

            <div>

                <label class="block text-sm font-semibold mb-2">

                    Full name

                </label>


                <input
                    name="name"
                    value="{{ old('name') }}"
                    required
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500"
                    placeholder="Your name"
                >

            </div>


            <!-- EMAIL -->

            <div>

                <label class="block text-sm font-semibold mb-2">

                    Email

                </label>


                <input
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500"
                    placeholder="you@example.com"
                >

            </div>


            <!-- PASSWORD -->

            <div>

                <label class="block text-sm font-semibold mb-2">

                    Password

                </label>


                <input
                    name="password"
                    type="password"
                    required
                    minlength="6"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500"
                    placeholder="Minimum 6 characters"
                >

            </div>


            <!-- CONFIRM PASSWORD -->

            <div>

                <label class="block text-sm font-semibold mb-2">

                    Confirm password

                </label>


                <input
                    name="password_confirmation"
                    type="password"
                    required
                    minlength="6"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500"
                    placeholder="Repeat password"
                >

            </div>


            <!-- BUTTON -->

            <button
                type="submit"
                class="w-full rounded-xl bg-blue-600 hover:bg-blue-700 text-white py-3.5 font-bold"
            >

                Create SwiftTrack Account

            </button>

        </form>


        <!-- LOGIN -->

        <p class="text-center text-slate-500 mt-6">

            Already registered?

            <a
                class="text-blue-600 font-bold"
                href="{{ route('user.login') }}"
            >

                Login

            </a>

        </p>


        <!-- ADMIN -->

        <p class="text-center mt-4">

            <a
                class="text-xs text-slate-400 hover:text-blue-600"
                href="{{ route('admin.login') }}"
            >

                🔐 Admin Login

            </a>

        </p>

    </div>

</div>

</body>

</html>