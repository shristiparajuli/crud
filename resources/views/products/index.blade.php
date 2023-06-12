<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
 @auth
 <p> LOGGED IN ! </p>
 <form action="/logout" method="post">
    @csrf
    <button>Log out</button>
 </form>
 
    <div style="border: 3px solid #black;">
        <h2> Create a new post </h2>
        <form action="/create-post" method="post"> 
        @csrf 
        <input type="text" name="title" placeholder="title">
        <textarea name="description" placeholder="Content"></textarea>
        <button> Save Post </button>
        </form>
    </div>

    <div style="border: 3px solid #black;">
        <h2> ALL POSTS</h2>
        @foreach($posts as $post)
        <div style="border: 3px solid #black;">
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
    </div>


 @else
 <div style="border: 3px solid #black;">
    <h2>Register</h2>
    <form action="/register" method="POST">
        @csrf
        <input name="name" type="text" placeholder="name">
        <input name="email" type="text" placeholder="email">
        <input name="password" type="password" placeholder="password">
        <button> Register </button>
    </form>

 <div style="border: 3px solid #black;">
    <h2>Login</h2>
    <form action="/login" method="POST">
        @csrf
        <input name="loginname" type="text" placeholder="name">
        <input name="loginpassword" type="password" placeholder="password">
        <button type="submit"> Login </button>
    </form>
     
 @endauth
</body>
</html>