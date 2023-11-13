public class T2 extends Thread{
  private Shared shared;

  public T2(Shared shared){
    this.shared = shared;
  }

  public void run(){
    while(true){
      try{
        sleep(300);
      }catch(InterruptedException e){e.printStackTrace();}
      
      shared.sharedNotify();
      int x = shared.getValue();

      if(x == -1) return;
      else continue;
      
    }
  }
  
}
