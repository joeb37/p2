<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Generator</title>
    <?php require 'password.php'; ?>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/styles.css">
    <script type="text/javascript" src="passcheck/passchk.js"></script>
    <script type="text/javascript" src="passcheck/common.js"></script>
    <script type="text/javascript" src="passcheck/frequency.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <h1>xkcd-Style Password Generator</h1>
            <p>
                This web app will generate an <a href="http://xkcd.com/936/">xkcd style password</a> that conforms
                to the parameters selected by the user.
            </p>
            <p>Press "Create Password" to generate a new random password.</p>
            <p>You may alter the number of words in the password, whether or not to include a
                digit or a special character, the capitalization style, and the separator style
                using the controls below.</p>
        </div>
        <div class="row">
            <div class="well col-md-12 pw-output">
                <h2 id="passcheck_pass">
                    <?php echo $result ?>
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 well">
                <form action="index.php" method="GET">
                    <label for="words">Number of Words: </label>
                    <input class="form-control" id="words" name="words" type="number" min="1" max="9" value="<?php echo $wordCount ?>">
                    <br>
                    <label for="special">Include a special symbol, e.g. &amp;, $, #: </label>
                    <input id="special" name="special" type="checkbox" onclick="specialCharCBClicked(this)" <?php echo $incSpecial == "on" ? "checked" : "" ?> >
                    <br>
                    <label for="digit">Include a digit: </label>
                    <input id="digit" name="digit" type="checkbox" <?php echo $incNumber == "on" ? "checked" : "" ?> >
                    <br>
                    <label for="capitalization">Capitalization: </label>
                    <select class="form-control" id="capitalization" name="capitalization">
                        <option value="lower" <?php echo $capitalization == "lower" ? "selected" : "" ?> >Lower Case</option>
                        <option value="upper" <?php echo $capitalization == "upper" ? "selected" : "" ?> >Upper Case </option>
                        <option value="title" <?php echo $capitalization == "title" ? "selected" : "" ?> >Title Case</option>
                    </select>
                    <br>
                    <label for="separator">Separator Type: </label>
                    <select class="form-control"  id="separator" name="separator">
                        <option value="none" <?php echo $separator == "none" ? "selected" : "" ?> >None</option>
                        <option value="camel" <?php echo $separator == "camel" ? "selected" : "" ?> >Camel Case</option>
                        <option value="hyphens" <?php echo $separator == "hyphens" ? "selected" : "" ?> >Hyphens</option>
                        <option value="spaces" <?php echo $separator == "spaces" ? "selected" : "" ?> >Spaces</option>
                    </select>
                    <div class="errorText">
                        <ul>
                        <?php foreach($errorObject as $key => $value) : ?>
                            <li><?php echo $value ?></li>
                        <?php endforeach ?>
                        </ul>
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary">Create Password</button>
                </form>
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-info btn-sm" onclick="analyze()">Analyze Password</button>
                <div class="password-stats" id="passchk_result"></div>
            </div>
        </div>
    </div>
</body>
</html>
