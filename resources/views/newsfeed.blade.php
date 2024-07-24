<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>

    <style>
        .reg-form {
            margin: 5px;
            padding: 5px;
        }
    </style>
</head>

<body>

    <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>

   


    @auth

    {{-- navigation --}}
        <div style="border: 2px solid black">
            <h1>Logged in</h1>

            {{-- logout --}}
            <div>
                <form action="/logout" method="post">
                    @csrf
                    <div class="reg-form">
                        <button>Log out</button>
                    </div>
                </form>
            </div>

            {{-- Go to your profile --}}
            <div class="reg-form">
                <a href="/"><button>Me</button></a>
            </div>

            {{-- Go to your feed --}}
            <div class="reg-form">
                <a href="/newsfeed"><button>Newsfeed</button></a>
            </div>

            
            
        </div>

      

        {{-- Display the post --}}
        <div style="margin-top: 10px;">
            <h1>BlogPost</h1>
            <div>
                @foreach ($fetchAllPost as $allPost)
                    <div style="border: 2px solid black; margin: 10px; padding: 10px">
                        <h2>{{ $allPost->title }}</h2>
                        <p>{{ $allPost->body }}</p>
                        <p>By: {{ $allPost->user->name }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div style="border: 2px solid black; margin-bottom: 10px;">
            <h1>Log in</h1>
            <div>
                <form action="/login" method="post">
                    @csrf
                    @method('post')
                    <div class="reg-form">
                        <label>Name</label>
                        <input type="text" name="loginname" placeholder="Enter your name">
                    </div>

                    <div class="reg-form">
                        <label>Password</label>
                        <input type="password" name="loginpassword" placeholder="Enter your password">
                    </div>

                    <div class="reg-form">
                        <button>Login</button>
                    </div>

                </form>
            </div>
        </div>


        <div style="border: 2px solid black">
            <h1>Create An Account</h1>
            <div>
                <form action="/register" method="post">
                    @csrf
                    @method('post')
                    <div class="reg-form">
                        <label>Name</label>
                        <input type="text" name="name" placeholder="Enter your name">
                    </div>

                    <div class="reg-form">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Enter your email">
                    </div>

                    <div class="reg-form">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter your password">
                    </div>

                    <div class="reg-form">
                        <button>SignUp</button>
                    </div>

                </form>
            </div>
        </div>
    @endauth




</body>

</html>
