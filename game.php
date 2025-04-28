<?php
    $playAgain = 1;

    while ($playAgain == 1) {
        $min = 1;
        $max = 100;
        $number = mt_rand($min, $max);

        $easy = 10;
        $medium = 5;
        $hard = 3;

        echo "Welcome to the Number Guessing Game!\n";
        echo "I'm thinking of a number between $min and $max.\n";
        echo "\nPlease select the difficulty level:
        1. Easy ($easy chances)
        2. Medium ($medium chances)
        3. Hard ($hard chances)\n";
        echo "Enter your choice: ";
        $handle = fopen("php://stdin", "r");
        $choice = (int) trim(fgets($handle));


        switch ($choice) {
            case 1:
                echo "\nGreat! You have selected the Easy difficulty level.\n";
                $chances = $easy;
                break;
            case 2:
                echo "\nGreat! You have selected the Medium difficulty level.\n";
                $chances = $medium;
                break;
            case 3:
                echo "\nGreat! You have selected the Hard difficulty level.\n";
                $chances = $hard;
                break;
            default:
                echo "\nInvalid choice! Defaulting to Easy ($easy chances).\n";
                $chances = $easy;
        }

        echo "You have $chances chances to guess the number.\n";
        echo "Let's start the game!\n\n";

        for ($attempts=1; $attempts <= $chances; $attempts++) { 
            echo "Enter your guess: ";
            $guess = (int) trim(fgets($handle));

            if ($guess == $number) {
                echo "Congratulations! You guessed the correct number in $attempts " . ($attempts == 1 ? "attempt" : "attempts") . ".\n";
                break;
            } elseif ($number > $guess) {
                echo "Incorrect! The number is greater than $guess.\n";
            } else {
                echo "Incorrect! The number is less than $guess.\n";
            }
        }
        
        if ($attempts > $chances) {
            echo "\nGame over! The number was $number.\n";
        }

        echo "Would you like to play again?\n";
        echo "y/n: ";
        $choice = (string) trim(fgets($handle));

        switch (strtolower($choice)) {
            case 'y':
            case 'yes':
                $playAgain = 1;
                echo "You have selected to play again!\n\n";
                break;
            case 'n':
            case 'no':
                $playAgain = 0;
                echo "You have selected to not play again.\n\n";
                break;
            default:
                $playAgain = 0;
                echo "Invalid choice! Default is to not play again.\n\n";
        }

        fclose($handle);
    }
?>