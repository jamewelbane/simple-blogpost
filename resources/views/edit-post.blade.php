<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post</title>

    <style>
        .reg-form {
            margin: 5px;
            padding: 5px;
        }
    </style>
</head>
<body>
    <div style="border: 2px solid black; margin-top: 10px;">
        <h1>Edit your post</h1>
        <div>
            <form action="/edit-post/{{$post->id}}" method="post">
                @csrf
                @method('put')
                <div class="reg-form">
                    <input type="text" name="title" value="{{$post['title']}}" placeholder="Title">
                </div>

                <div class="reg-form">
                    <textarea name="body" cols="30" rows="10"  placeholder="What's on your mind?">{{$post['body']}}</textarea>
                </div>

                <div class="reg-form">
                    <button>Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>