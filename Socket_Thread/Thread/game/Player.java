public class Player extends Thread {
    int position = 0;
    int index; // Index of the Thread
    Game game; // Game

    Player(int index, Game game) {
        this.index = index;
        this.game = game;
    }

    @Override
    public void run() {
        int roundNumber;
        // Loop
        while (true) {
            roundNumber = game.getRound(); // Gets the Round Number
            
            if (roundNumber == -1) { // Lost
                System.out.println("[" + index + "] " + "Oh no, I've lost :(");
                break;
            } else if (roundNumber == index) { // It's my turn
                System.out.println("[" + index + "] " + "Play - Current Score:" + position);
                position += rollDice();
                if (position > 100) {
                    System.out.println("[" + index + "] " + "Yeah I won :) I got more than 100, my score is:" + position);
                    game.setRound(-1);
                    break;
                } else { // Pass
                    System.out.println("[" + index + "] " + " Not enough, Pass. My current Score is:" + position);
                    game.setRound(1 - index);
                    // Notify
                    try {
                        game.gameNotify();
                    } catch (InterruptedException e) {
                        e.printStackTrace();
                    }
                    // Go to sleep
                    try {
                        game.sleep();
                    } catch (InterruptedException e) {
                        e.printStackTrace();
                    }
                }
            } else { // Not my turn
                // Notify
                try {
                    game.gameNotify();
                } catch (InterruptedException e) {
                    e.printStackTrace();
                }
                try {
                    System.out.println("[" + index + "]" + "Not my turn");
                    //chiamata bloccante 
                    game.gameWait();
                } catch (InterruptedException e) {
                    e.printStackTrace();
                }
            }
        }
        System.out.println("[" + index + "] " + "I'm done");
        // Notify the other
        try {
            game.gameNotify();
        } catch (InterruptedException e) {
            e.printStackTrace();
        }
    }

    int rollDice() {
        int dice = (int) (Math.random() * 10 + 1);
        System.out.println("\uD83C\uDFB2 extracted:" + dice);
        return (dice);
    }


}