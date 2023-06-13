<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .text-center {
            text-align: center;
        }

        .text-center a {
            text-decoration: none;
            color: #4caf50;
            font-weight: bold;
        }

        /* Hide the register form by default */
        #register-form {
            display: none;
        }

        /* Styles for the post form */
        .post-form {
        margin-bottom: 20px;
        }

        .post-form .form-group {
        margin-bottom: 10px;
        }

        .post-form .form-input,
        .post-form .form-textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        }

        .post-form .btn-submit {
        background-color: #4CAF50;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        }

        /* Styles for the post list */
        .post-list {
        margin-top: 20px;
        }

        .post-list h2 {
        margin-bottom: 10px;
        }

        .post-item {
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        }

        .post-item h3 {
        margin-top: 0;
        font-size: 18px;
        }

        .post-item p {
        margin-bottom: 10px;
        }

        .post-item-actions {
        display: flex;
        justify-content: flex-end;
        }

        .post-item-actions .btn-edit
        {
        background-color: #4CAF50;
        color: #fff;
        padding: 6px 10px;
        border: none;
        border-radius: 6px;
        margin-left: 4px;
        cursor: pointer;
        }

        .post-item-actions .btn-delete{
        background-color: #af4c4c;
        color: #fff;
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        margin-left: 10px;
        cursor: pointer;
        }

    </style>
</head>
<body>
 @auth
 <form action="/logout" method="post">
    @csrf
    <button>Log out</button>
 </form>

 <h2>Create a new post</h2>
 <form action="/create-post" method="post" class="post-form">
   @csrf
   <div class="form-group">
     <input type="text" name="title" placeholder="Title" class="form-input">
   </div>
   <div class="form-group">
     <textarea name="description" placeholder="Content" class="form-textarea"></textarea>
   </div>
   <input type="submit" value="Save Post" class="btn-submit">
 </form>
 
 <div class="post-list">
   <h2>All Posts</h2>
   @foreach($posts as $post)
   <div class="post-item">
     <h3>{{$post['title']}} by {{$post->user->name}}</h3>
     <p>{{$post['description']}}</p>
     <div class="post-item-actions">
       <a href="/edit-post/{{$post->id}}" class="btn-edit">Edit</a>
       <form action="/delete-post/{{$post->id}}" method="post" class="form-delete">
         @csrf
         @method('Delete')
         <button class="btn-delete">Delete</button>
       </form>
     </div>
   </div>
   @endforeach
 </div>
 
        {{-- <h2> Create a new post </h2>
        <form action="/create-post" method="post"> 
        @csrf 
        <div class="form-group">
        <input type="text" name="title" placeholder="title">
        </div>
        <div class="form-group">
        <textarea name="description" placeholder="Content"></textarea>
        </div>
        <input type="submit" value="Save Post">
        </form>

    <div style="display: flex;">
        <h2> ALL POSTS</h2>
        @foreach($posts as $post)
        <div style="display: flex;">
            <h3> {{$post['title']}} by {{$post->user->name}}</h3>
            {{$post['description']}}
            <p> <a href="/edit-post/{{$post->id}}"> Edit </a></p>
            <form action="/delete-post/{{$post->id}}" method="post"> 
                @csrf
                @method('Delete')
                <button>Delete</button>
            </form>
        </div>
        @endforeach
    </div> --}}
 @else   

 <div class="container">
    <h2 id="form-title">User Login</h2>
    <div id="login-form">
        <form action="/login" method="POST">
            @csrf
            <div class="form-group">
                <input name="loginname" type="text" placeholder="Enter your name">
            </div>
            <div class="form-group">
                <input name="loginpassword" type="password" placeholder="Enter your password">
            </div>
            <input type="submit" value="Login">
        </form>
        <p>Don't have an account? <a href="#" id="toggle-register-form">Register</a></p>
    </div>

    <div id="register-form" style="display: none;">
        <form action="/register" method="POST">
            @csrf
            <div class="form-group">
                <input name="name" type="text" placeholder="Name"><br>
            </div>
            <div class="form-group">
                <input name="email" type="text" placeholder="Email"><br>
            </div>
            <div class="form-group">
                <input name="password" type="password" placeholder="Password"><br>
            </div>
            <input type="submit" value="Register">
        </form>
        <p>Already have an account? <a href="#" id="toggle-login-form">Login</a></p>
    </div>
</div>

<script>
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const formTitle = document.getElementById('form-title');
    const toggleRegisterFormLink = document.getElementById('toggle-register-form');
    const toggleLoginFormLink = document.getElementById('toggle-login-form');

    toggleRegisterFormLink.addEventListener('click', function(e) {
        e.preventDefault();
        loginForm.style.display = 'none';
        registerForm.style.display = 'block';
        formTitle.innerText = 'User Registration';
    });

    toggleLoginFormLink.addEventListener('click', function(e) {
        e.preventDefault();
        loginForm.style.display = 'block';
        registerForm.style.display = 'none';
        formTitle.innerText = 'User Login';
    });
</script>    
@endauth
</body>
</html>