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
        1. Easy ($easy chances and one tip)
        2. Medium ($medium chances and one tip)
        3. Hard ($hard chances and no tip)\n";
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
        echo "Game starting in 3 seconds...\n\n";
        sleep(3);

        $startTime = microtime(true); // Starts counting.

        for ($attempts=1; $attempts <= $chances; $attempts++) {
            if (($attempts == 6 && $chances == $easy) || ($attempts == 4 && $chances == $medium)) {
                echo "\nDo you want a tip?\n";
                echo "y/n: ";
                $choice = (string) trim(fgets($handle));

                switch (strtolower($choice)) {
                    case 'y':
                    case 'yes':
                        if ($number > 9) {
                            $tip = substr((string)$number, 0, 1);
                            echo "\nTip: The number starts with $tip.\n\n";
                        } else {
                            echo "\nThe number is only one digit.\n\n";
                        }
                        sleep(2);
                        break;
                    case 'n':
                    case 'no':
                        echo "\nYou have chosen to not have a tip, continuing the game...\n\n";
                        sleep(2);
                        break;
                    default:
                        echo "\nInvalid choice! Continuing the game...\n\n";
                        sleep(2);
                        break;
                }
            }
            echo "Enter your guess: ";
            $guess = (int) trim(fgets($handle));

            if ($guess == $number) {
                $endTime = microtime(true);
                $timerSeconds = round($endTime - $startTime);
                echo "\nCongratulations! You guessed the correct number in $attempts " . ($attempts == 1 ? "attempt" : "attempts") . " and took $timerSeconds seconds.\n\n";
                break;
            } elseif ($number > $guess) {
                echo "\nIncorrect! The number is greater than $guess.\n";
            } else {
                echo "\nIncorrect! The number is less than $guess.\n";
            }
        }
        
        if ($attempts > $chances) {
            $endTime = microtime(true);
            $timerSeconds = round($endTime - $startTime);
            echo "\nGame over! The number was $number and you took $timerSeconds seconds.\n\n";
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