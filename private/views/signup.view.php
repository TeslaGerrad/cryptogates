<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            padding: unset;
            margin: unset;
            box-sizing: border-box;
        }
        .wrapper {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        body{
            height: 100vh;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        .wrapper h1 {
            text-transform: capitalize;
            color: #fff;
            text-align: center;
            padding: 15px;
        }
        form {
            margin: 15px;
            padding: 20px;
            width: 60%;
            background: #00001a;
            color: aliceblue;
        }
        form  .form-group {
            padding: 2em;
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            /* justify-content: center/; */
            align-items: center;
        }

        label {
            padding: 10px;
            width: 20%;
            font-size: x-large;
        }

        input {
            width: 70%;
            font-size: large;
            padding: 1em;
            color: azure;
            background-color: transparent;
            border: unset;
            border-bottom: solid #38386e7c;
        }

        btn-c {
            padding: 4.5em;
            width: 100%;
        }

        button {
            cursor: pointer;
            margin: auto;
            padding: 0.6em 3em;
            font-size: x-large;
            display: flex;
            background-color: #b0b0b662;
            border: unset;
            border-radius: 50px;
            color: aliceblue;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <form action="<?= ROOT?>signup" method="post">
            <h1>Login</h1>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" name="email" placeholder="Enter Your Email">
            </div>
            <div class="form-group">
                <label for="username">Username :</label>
                <input type="username" name="user_name" placeholder="Enter Your Username">
            </div>
            
            <div class="form-group">
                <label for="password">Password :</label>
                <input type="password" name="password" placeholder="Enter Your Password">
            </div>
            <div class="form-group">
                <label for="password1">Confirm Password:</label>
                <input type="password" name="password1" placeholder="Enter Your Password">
            </div>
            <div class="btn-c">
                <button type="submit">Submit</button>
            </div>
        </form>
</body>
</html>