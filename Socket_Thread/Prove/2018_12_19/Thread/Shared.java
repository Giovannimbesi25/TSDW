import java.util.Random;

public class Shared {
  
  private int value;

  public Shared(){
    java.util.Random r = new Random();
    this.value = r.nextInt(11);
  }

  public synchronized void setValue(int new_value){
    value = new_value;
  }

  public synchronized int getValue(){
    return value;
  }

  public synchronized void sharedWait() throws InterruptedException{
    wait();
  }

  public synchronized void sharedNotify(){
      notifyAll();
  }
}







