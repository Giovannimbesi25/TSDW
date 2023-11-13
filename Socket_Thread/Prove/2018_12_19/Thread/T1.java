import java.util.Random;

public class T1 extends Thread{
  private int m;
  private Shared shared;

  public T1(Shared shared){
    this.shared = shared;
  }

  public void run(){
    while(true){
      try{
       sleep(100);
      }catch(InterruptedException e){e.printStackTrace();}
      Random r = new Random();
      m = r.nextInt(11);

      if(shared.getValue() == -1 ) return;
      if(shared.getValue() == m) {
        System.out.println("RISPOSTA CORRETTA");
        shared.setValue(-1);
        return;
      }
      
      if((Math.abs(m) - Math.abs(shared.getValue())) > 5){

        System.out.println("risposta MOLTO sbagliata");
        try{
          shared.sharedWait();
        }catch(InterruptedException e){
          e.printStackTrace();
        }
        continue;
      }
      else {
        System.out.println("risposta sbagliata");
      }
    }
  }
  
}
