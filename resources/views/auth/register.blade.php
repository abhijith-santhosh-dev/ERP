<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;    
            font-family: Raleway, sans-serif;
        }

        body {
            background: linear-gradient(90deg, #C7C5F4, #776BCC);      
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .screen {      
            background: linear-gradient(90deg, #5D54A4, #7C78B8);      
            position: relative;    
            height: 600px;
            width: 360px;    
            box-shadow: 0px 0px 24px #5C5696;
            border-radius: 10px;
        }

        .screen__content {
            z-index: 1;
            position: relative;    
            height: 100%;
            padding: 50px;
        }

        .register {
            width: 100%;
        }

        .register__field {
            padding: 15px 0px;    
            position: relative;
                
        }

        .register__icon {
            position: absolute;
            top: 25px;
            color:rgb(163, 24, 24);
            left: 10px;
        }

        .register__input {
            border: none;
            border-bottom: 2px solid #D1D1D4;
            background: none;
            padding: 10px;
            padding-left: 30px;
            font-weight: 700;
            width: 100%;
            transition: .2s;
            color: #fff;
        }

        .register__input:focus {
            outline: none;
            border-bottom-color: #6A679E;
        }

        .register__submit {
            background: #fff;
            font-size: 14px;
            margin-top: 30px;
            padding: 16px 20px;
            border-radius: 26px;
            border: 1px solid #D4D3E8;
            text-transform: uppercase;
            font-weight: 700;
            display: flex;
            align-items: center;
            width: 100%;
            color: #4C489D;
            box-shadow: 0px 2px 2px #5C5696;
            cursor: pointer;
            transition: .2s;
            justify-content: center;
        }

        .register__submit:hover {
            border-color: #6A679E;
            outline: none;
        }
        .register__input::placeholder {
    color: #FFD700; /* Gold color for vibrant placeholder */
    font-weight: bold;
}

.register__input:focus {
    outline: none;
    border-bottom-color: #FFD700; /* Gold border on focus */
}
    </style>
</head>
<body>
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <h1 style="color: white; text-align: center;">Register</h1>
                <form method="POST" action="{{ route('register') }}" class="register">
                    @csrf
                    <div class="register__field">
                        <i class="register__icon fas fa-user"></i>
                        <input type="text" name="first_name" id="first_name" class="register__input" placeholder="First Name" required>
                    </div>
                    <div class="register__field">
                        <i class="register__icon fas fa-user"></i>
                        <input type="text" name="last_name" id="last_name" class="register__input" placeholder="Last Name" required>
                    </div>
                    <div class="register__field">
                        <i class="register__icon fas fa-envelope"></i>
                        <input type="email" name="email" id="email" class="register__input" placeholder="Email" required>
                    </div>
                    <div class="register__field">
                        <i class="register__icon fas fa-lock"></i>
                        <input type="password" name="password" id="password" class="register__input" placeholder="Password" required>
                    </div>
                    <div class="register__field">
                        <i class="register__icon fas fa-lock"></i>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="register__input" placeholder="Confirm Password" required>
                    </div>
                    <button type="submit" class="register__submit">Register</button>
                    <a href="{{ route('login') }}" class="register__submit" style="background: #4C489D; color: white; text-decoration: none; text-align: center; margin-top: 10px;">Login</a>

                </form>

            </div>
        </div>
    </div>
</body>
</html>
