<!doctype html>
<html>
    <head>
        <title>e15 Project 1</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="wrapper">
            <h1>e15 Project 1</h1>
            <p>by: Bry Power</p>
            <div class="form-wrapper">
                <form method="POST" action="process.php" class="form">
                    <fieldset>
                        <legend>Run Processors on a String</legend>
                        <label for="inputString">String to process:</label>
                        <input type="text" id="inputString" name="inputString">
                        <button type="submit" class="button">Process</button>
                    </fieldset>
                </form>
                <?php if(isset($results)) : ?>
                    <div class="results">
                        <h2>Is Palindrome? </h2>
                        <p><?= $isPalindrome ?></p>

                        <h2>Vowel Count</h2>
                        <p><?= $vowelCount ?></p>

                        <h2>Shifted Letters</h2>
                        <p><?= $shiftedLetters ?></p>
                    </div>

                <?php endif ?>
            </div>
        </div>
    </body>
</html>