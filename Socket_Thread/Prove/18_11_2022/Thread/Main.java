public class Main{
  public static void main(String[] args)throws InterruptedException{
    Shared shared = new Shared();
    MyThread t1 = new MyThread("Giovanni", shared);
    MyThread t2 = new MyThread("Bellomo", shared);
    MyThread t3 = new MyThread("Rosario", shared);
    MyThread t4 = new MyThread("Ruben", shared);
    MyThread t5 = new MyThread("Paolo", shared);

    t1.start();
    t2.start();
    t3.start();
    t4.start();
    t5.start();

    t1.join();
    t2.join();
    t3.join();
    t4.join();
    t5.join();
    
    System.out.println("Shared ha valore "+ shared.getValue());
    System.out.println("The winner is: "+ shared.getWinner());

  }
}
