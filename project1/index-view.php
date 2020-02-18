<!doctype html>
<html>
    <head>
        <title>e15 Project 1</title>
    </head>
    <body>
        <h1>e15 Project 1</h1>

        <form method="POST" action="process.php">
            <label for="inputString">Enter a String:</label>
            <input type="text" id="inputString" name="inputString">
            <button type="submit">Process</button>
        </form>

        <?php if(isset($results)) : ?>
            <h2>Is Palindrome?</h2>
            <?= $isPalindrome ?>

            <h2>Vowel Count</h2>
            <?= $vowelCount ?>

            <h2>Shifted Letters</h2>
            <?= $shiftedLetters ?>

        <?php endif ?>
    </body>
</html>