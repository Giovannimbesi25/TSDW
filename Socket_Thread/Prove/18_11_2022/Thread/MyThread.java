import java.util.Random;

public class MyThread extends Thread{
  private String name;
  private Shared sharedValue;

  public MyThread(String name, Shared sharedValue){
    this.name = name;
    this.sharedValue = sharedValue;
  }

  public void run(){
    while(true){
      Random r = new Random();
      int randomValue = r.nextInt(81) + 10;
      int current_value = sharedValue.getValue();
      sharedValue.setValue(randomValue);
      
      System.out.println("Sono il thread "+name+": sample valeva "+current_value+", adesso vale "+randomValue);
      if(current_value == randomValue){
        System.out.println(name+ " termino...");
        if(sharedValue.getWinner() == "")
          sharedValue.setWinner(name);
        break;
      }
    }
  }
}
