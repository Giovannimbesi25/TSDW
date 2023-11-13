import java.util.Random;

public class ThreadP extends Thread{
    private String name;
    private Shared shared;

    public ThreadP(String threadName, Shared shared){
      this.name = threadName;
      this.shared = shared;
    }

    public void run(){
      while(true){
        try {
          sleep(300);
        } catch (InterruptedException e) {}


        int m = shared.getShared();
        if(m % 2 == 0){
          System.out.println(name+": "+ m);
          Random rand = new Random();
          int random = rand.nextInt(5)*2 + 1; 
          shared.setShared(random);
          shared.sharedNotify();
        }else {
          try {
              // attende
            shared.sharedWait();
          } catch (InterruptedException e) { }
        }
        
        
      }
    }
}
