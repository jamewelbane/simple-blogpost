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

    <div>
        @if (session('error'))
            <p>{{ session('error') }}</p>
            <a href="/"><button>OK</button></a>
        @endif

        @if (session('success'))
            <p>{{ session('success') }}</p>
            <a href="/"><button>OK</button></a>
        @endif
    </div>


    @auth


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

            {{-- Go to newsfeed --}}
            <div class="reg-form">
                <a href="/newsfeed"><button>Newsfeed</button></a>
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
        <div style=" margin-top: 10px;">
            <h1>Your BlogPost</h1>
            <div>
                @foreach ($fetchPost as $post)
                    <div style="border: 2px solid black; margin: 10px; padding: 10px">
                        <h2>{{ $post['title'] }}</h2>
                        <p>{{ $post['body'] }}</p>
                        

                        <div style="display: flex; align-items: center;">
                            <a href="/edit-post/{{ $post->id }}"><button style="margin-right: 10px;">Edit</button></a>
                            <form action="/delete-post/{{ $post->id }}" method="post" style="margin-right: 10px;">
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
