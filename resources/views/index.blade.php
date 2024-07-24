<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

    <div class="navbar">
        <div class="navbar-left">
            <a href="/">Home</a>
            <a href="/newsfeed">Newsfeed</a>
            <a href="/">Profile</a>
        </div>
        <div class="navbar-right">
            @auth
                <form action="/logout" method="post" style="display: inline;">
                    @csrf
                    <button>Log out</button>
                </form>
            @else
                <a href="/login">Log in</a>
                <a href="/register">Sign Up</a>
            @endauth
        </div>
    </div>

    <div class="container">
        <div>
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div>
            @if (session('error'))
                <div class="message error">{{ session('error') }}</div>
                <a href="/"><button>OK</button></a>
            @endif

            @if (session('success'))
                <div class="message success">{{ session('success') }}</div>
                <a href="/"><button>OK</button></a>
            @endif
        </div>

        @auth
            <div style="border: 2px solid black">
                <h1>Logged in</h1>
                <div style="margin-left: 2px">
                    <h2>Hello, {{auth()->user()->name}}!</h2>
                </div>
               
            </div>

            {{-- create post --}}
            <div style="border: 2px solid black; margin-top: 10px;">
                <h1>Share something</h1>
                <div>
                    <form action="/blog-post" method="post">
                        @csrf
                        <div class="reg-form">
                            <input type="text" name="title" placeholder="Title">
                        </div>
                        <div class="reg-form">
                            <textarea name="body" cols="30" rows="10" placeholder="What's on your mind?"></textarea>
                        </div>
                        <div class="reg-form">
                            <button>Post</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Display the post --}}
            <div style="margin-top: 10px;">
                <h1>Your BlogPost</h1>
                <div>
                    @foreach ($fetchPost as $post)
                        <div class="post">
                            <h2>{{ $post['title'] }}</h2>
                            <p>{{ $post['body'] }}</p>
                            <div class="actions">
                                <a href="/edit-post/{{ $post->id }}"><button>Edit</button></a>
                                <form action="/delete-post/{{ $post->id }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button>Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="container">
                <h1>Log in</h1>
                <div>
                    <form action="/login" method="post">
                        @csrf
                        @method('post')
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="loginname" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="loginpassword" placeholder="Enter your password">
                        </div>
                        <div class="form-group">
                            <button>Login</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="container">
                <h1>Create An Account</h1>
                <div>
                    <form action="/register" method="post">
                        @csrf
                        @method('post')
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Enter your password">
                        </div>
                        <div class="form-group">
                            <button>SignUp</button>
                        </div>
                    </form>
                </div>
            </div>
        @endauth
    </div>

</body>

</html>
