public class Shared {
  private int m=0;

  public int getShared(){
    return m;
  }

  public synchronized void setShared(int new_value){
    this.m = new_value;
  }

  public synchronized void sharedWait() throws InterruptedException{
    wait();
  }

  public synchronized void sharedNotify(){
    notifyAll();
  }

  
}



