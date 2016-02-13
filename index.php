<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Generator</title>
    <?php require('password.php') ?>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/styles.css">
    <script type="text/javascript" src="passcheck/passchk.js"></script>
    <script type="text/javascript" src="passcheck/common.js"></script>
    <script type="text/javascript" src="passcheck/frequency.js"></script>
    <script type="text/javascript">
     window.onload = function() {
       document.getElementById("specialCount").disabled = <?php echo $_GET['special'] == "on" ? "false" : "true" ?>
     }

     function specialCharCBClicked(elem) {
       document.getElementById("specialCount").disabled = !elem.checked;
     }
    </script>
</head>
<body>
    <div class="container">
        <div class="well col-md-12 pw-output">
            <h2 id="passcheck_pass">
                <?php echo makePassword($_GET['words'], $_GET['special'] == 'on', $_GET['specialCount'],
                                        $_GET['digit'] == 'on', $_GET['separator'], $_GET['capitalization']); ?>
            </h2>
        </div>
        <div class="col-md-6">
            <form class="well">
                <label for="words">Number of Words: </label>
                <input class="form-control" id="words" name="words" type="number" min="1" max="9" value="<?php echo $_GET['words'] ?>">
                <br>
                <label for="special">Include a special symbol, e.g. &amp;, $, #: </label>
                <input id="special" name="special" type="checkbox" onclick="specialCharCBClicked(this)" <?php echo $_GET['special'] == "on" ? "checked" : "" ?> >
                <label for="specialCount">How many? </label>
                <input id="specialCount" name="specialCount" type="number" min="1" max="9" value="<?php echo $_GET['specialCount'] ?>">
                <br>
                <label for="digit">Include a digit: </label>
                <input id="digit" name="digit" type="checkbox" <?php echo $_GET['digit'] == "on" ? "checked" : "" ?> >
                <br>
                <label for="capitalization">Capitalization: </label>
                <select class="form-control" id="capitalization" name="capitalization">
                    <option value="lower" <?php echo $_GET['capitalization'] == "lower" ? "selected" : "" ?> >Lower Case</option>
                    <option value="upper" <?php echo $_GET['capitalization'] == "upper" ? "selected" : "" ?> >Upper Case </option>
                    <option value="title" <?php echo $_GET['capitalization'] == "title" ? "selected" : "" ?> >Title Case</option>
                </select>
                <br>
                <label for="separator">Separator Type: </label>
                <select class="form-control"  id="separator" name="separator">
                    <option value="none" <?php echo $_GET['separator'] == "none" ? "selected" : "" ?> >None</option>
                    <option value="camel" <?php echo $_GET['separator'] == "camel" ? "selected" : "" ?> >Camel Case</option>
                    <option value="hyphens" <?php echo $_GET['separator'] == "hyphens" ? "selected" : "" ?> >Hyphens</option>
                    <option value="spaces" <?php echo $_GET['separator'] == "spaces" ? "selected" : "" ?> >Spaces</option>
                </select>
                <br>
                <button type="submit" class="btn btn-lg btn-primary">Create Password</button>
            </form>
        </div>
        <span id="passchk_result">Loading ...</span>
    </div>
</body>
</html>
