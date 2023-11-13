import java.util.Random;

import static java.lang.Thread.*;

public class hello {
    public static void main(String[] args) throws InterruptedException {
        Thread tMain = Thread.currentThread();
        System.out.println("Main Thread "+tMain.toString());

        myRunnable runnable = new myRunnable();
        Thread myThread2 = new Thread(runnable);

        myThread2.start();

    }
}