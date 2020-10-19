<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Password Generator</title>
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/script.js" defer></script>
</head>

<body>
    <div id="main-container">
        <div id="title-container">
            <b>Password Generator</b>
        </div>
        <form>
            <!-- Password length -->
            <div class="input-container">
                <label for="length">Password length:</label>
                <input type="number" id="length" size=2 name="length" min=1 max=35 value=6><br>
            </div>
            <!-- Include uppercase letters -->
            <div class="input-container">
                <input type="checkbox" id="uppercase" name="uppercase" value="uppercase<">
                <label for="uppercase"> Include uppercase letters</label><br>
            </div>
            <!-- Include lowercase letters -->
            <div class="input-container">
                <input type="checkbox" id="lowercase" name="lowercase" value="lowercase<">
                <label for="lowercase"> Include lowercase letters</label><br>
            </div>
            <!-- Include numbers -->
            <div class="input-container">
                <input type="checkbox" id="numbers" name="numbers" value="numbers<">
                <label for="numbers"> Include numbers</label><br>
            </div>
            <!-- Include symbols -->
            <div class="input-container">
                <input type="checkbox" id="symbols" name="symbols" value="symbols<">
                <label for="symbols"> Include symbols</label><br>
            </div>
            <div id="errors">&nbsp;</div>
            <div class="button-container">
                <button id="generate" class="action-btn">Generate Password</button>
                <button id="copy" class="action-btn">Copy to Clipboard</button>
            </div>

        </form>
    
        <div id="password-container">
            &nbsp;
        </div>
        <div id="strength-container">
            <div id="strength-indicator">
                &nbsp;
            </div>
        </div>
        <div id="instructions-container">
            <span>1. Select your password specifications</span><br>
            <span>2. Press "Generate Password" button</span><br>
            <span>3. Copy it, by pressing "Copy to Clipboard"</span>
        </div>
        <div id="strength-info-title">
            <b>Password Strength indicator</b>
        </div>
        <div id="strength-info-container">
            <div class="strength-info strength0">0</div><div class="strength-label">Too weak</div>
            <div class="strength-info strength1">1</div><div class="strength-label">Weak</div>
            <div class="strength-info strength2">2</div><div class="strength-label">Medium</div>
            <div class="strength-info strength3">3</div><div class="strength-label">Strong</div>
            <div class="strength-info strength4">4</div><div class="strength-label">Very Strong</div>
        </div>
    </div>
    

</body>

</html>