<?php
    namespace CaptchaGenerator;
    include __DIR__ . '/CaptchaGenerator/CaptchaGenerator.php';
    session_start();
    if (isset ($_POST['reset'])){
        session_destroy();
        header('Location: index.php');
    }

    $captcha = new CaptchaGenerator();
    $captcha->saveCanvas();
    if (isset($_POST['guess'])){
        $solution = $_SESSION['solution'];
        if ($_POST['guess'] == $solution){
            echo 'YAY!';
        } else {
            echo 'BOO!';
        }
    }
    $_SESSION['solution'] = $captcha->getSolution();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Captcha Generator</title>
</head>
<body>
    <h1>Captcha Challenge:</h1>
    <p>
        <img src="/tmp/captcha.png"/>
    </p>
    <form method="post">
        <p>
            <label for="captcha">Guess: </label>
            <input id="captcha" type="text" name="guess"/>
        </p>
        <p>
            <input type="submit" value="Submit"/>
            <input type="button" value="Reset"/>
        </p>
    </form>

    <p>The solution to this captcha is <?php echo $captcha->getSolution();?></p>
</body>
</html>