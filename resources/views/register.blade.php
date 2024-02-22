<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title> Dice Roller </title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:300);

    .login-page {
    width: 360px;
    padding: 8% 0 0;
    margin: auto;
    }
    .form {
    position: relative;
    z-index: 1;
    background: #FFFFFF;
    max-width: 360px;
    margin: 0 auto 100px;
    padding: 45px;
    text-align: center;
    box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }
    .form input {
    font-family: "Roboto", sans-serif;
    outline: 0;
    background: #f2f2f2;
    width: 100%;
    border: 0;
    margin: 0 0 15px;
    padding: 15px;
    box-sizing: border-box;
    font-size: 14px;
    }
    .form button {
    font-family: "Roboto", sans-serif;
    text-transform: uppercase;
    outline: 0;
    background: #4CAF50;
    width: 100%;
    border: 0;
    padding: 15px;
    color: #FFFFFF;
    font-size: 14px;
    -webkit-transition: all 0.3 ease;
    transition: all 0.3 ease;
    cursor: pointer;
    }
    .form button:hover,.form button:active,.form button:focus {
    background: #43A047;
    }
    .form .message {
    margin: 15px 0 0;
    color: #b3b3b3;
    font-size: 12px;
    }
    .form .message a {
    color: #4CAF50;
    text-decoration: none;
    }
    .form .register-form {
    display: none;
    }
    .container {
    position: relative;
    z-index: 1;
    max-width: 300px;
    margin: 0 auto;
    }
    .container:before, .container:after {
    content: "";
    display: block;
    clear: both;
    }
    .container .info {
    margin: 50px auto;
    text-align: center;
    }
    .container .info h1 {
    margin: 0 0 15px;
    padding: 0;
    font-size: 36px;
    font-weight: 300;
    color: #1a1a1a;
    }
    .container .info span {
    color: #4d4d4d;
    font-size: 12px;
    }
    .container .info span a {
    color: #000000;
    text-decoration: none;
    }
    .container .info span .fa {
    color: #EF3B3A;
    }
    body {
    background: #76b852; /* fallback for old browsers */
    background: rgb(141,194,111);
    background: linear-gradient(90deg, rgba(141,194,111,1) 0%, rgba(118,184,82,1) 50%);
    font-family: "Roboto", sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;      
    }
    </style>
</head>
<body>
    <div class="login-page">
    <h1 class="text-center">Dice Roller</h1>
    <div class="form">
        <form class="login_form" action="#" method="POST">
            @csrf
            <h3>Register</h3>
            <input name="phone_number" id="reg_phone" type="text" placeholder="Phone Number"/>
            <input name="password" id="reg_password" type="password" placeholder="password"/>
            <button id="btnRegister" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" >create</button>
            <p class="message">Already registered? <a href=" {{ route('web.login') }} ">Sign In</a></p>
        </form>
        
    </div>
    </div>

    <script>
   
    $('#btnRegister').click(function(){
        createUser();
    })

    function createUser(){
        $.ajax({
            url: ' {{ route('web.createUser') }} ',
            method: 'POST',
            data: {
                phone_number: $('#reg_phone').val(),
                password: $('#reg_password').val(),
                _token: '{{ csrf_token() }}',
            },
            success: function( response ){
                $( '#modal_subject' ).html( 'Congratulations' );
                $( '#modal_desc' ).html( 'Register Successful' );
                $( '#exampleModal' ).removeClass( 'hidden' );
                console.log( response );
            },
            error: function( error ){
                console.log( 'hello' );
            }
        });
    }
    </script>
    
    <?php echo view( 'templates/alert-modal' ); ?>

</body>