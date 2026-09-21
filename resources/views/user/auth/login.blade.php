<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login | SwiftTrack</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="min-h-screen bg-slate-950 flex items-center justify-center p-6">

<div class="w-full max-w-5xl bg-white rounded-3xl overflow-hidden shadow-2xl grid md:grid-cols-2">


    <!-- LEFT SIDE -->

    <div class="hidden md:flex bg-gradient-to-br from-blue-950 via-blue-900 to-blue-600 text-white p-12 flex-col justify-center">

        <div class="text-3xl font-black">

            🚚 Swift<span class="text-blue-300">Track</span>

        </div>


        <h1 class="text-5xl font-black mt-10 leading-tight">

            Track every parcel.
            <br>
            Every step.

        </h1>


        <p class="mt-5 text-blue-100 leading-7">

            Book parcels, follow delivery progress and see
            the complete status history from one simple dashboard.

        </p>


        <div class="mt-8 space-y-3 text-blue-50">

            <p>
                ✓ Easy parcel booking
            </p>

            <p>
                ✓ Instant tracking number
            </p>

            <p>
                ✓ Delivery status timeline
            </p>

        </div>

    </div>


    <!-- RIGHT SIDE / LOGIN FORM -->

    <div class="p-8 md:p-12">

        <div class="md:hidden text-2xl font-black text-slate-900 mb-8">

            🚚 Swift<span class="text-blue-600">Track</span>

        </div>


        <h2 class="text-3xl font-black text-slate-900">

            Welcome back 👋

        </h2>


        <p class="text-slate-500 mt-2 mb-8">

            Login to your SwiftTrack account.

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


        <!-- LOGIN FORM -->

        <form
            method="POST"
            action="{{ route('user.login.submit') }}"
            class="space-y-5"
        >

            @csrf


            <!-- EMAIL -->

            <div>

                <label class="block text-sm font-semibold mb-2">

                    Email address

                </label>


                <input
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
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
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500"
                    placeholder="••••••••"
                >

            </div>


            <!-- LOGIN BUTTON -->

            <button
                type="submit"
                class="w-full rounded-xl bg-blue-600 hover:bg-blue-700 text-white py-3.5 font-bold"
            >

                Login to SwiftTrack

            </button>

        </form>


        <!-- REGISTER -->

        <p class="text-center text-slate-500 mt-7">

            Don't have an account?

            <a
                class="text-blue-600 font-bold"
                href="{{ route('user.register') }}"
            >

                Create account

            </a>

        </p>


        <!-- ADMIN LOGIN -->

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