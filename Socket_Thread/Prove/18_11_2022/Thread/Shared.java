public class Shared {
  private int value;
  private String winner;

  public Shared(){
    this.value = 50;
    this.winner = "";
  }

  public synchronized int getValue(){
    return value;
  }

    public synchronized String getWinner(){
    return winner;
  }

  public synchronized void setValue(int new_value){
    this.value = new_value;    
  }

  public synchronized void setWinner(String player){
    this.winner = player;
  }
}
