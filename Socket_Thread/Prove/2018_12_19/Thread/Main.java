public class Main {
  public static void main(String[] args){
    System.out.println("Game started...");
    Shared x = new Shared();
    T1 t1 = new T1(x);
    T2 t2 = new T2(x);

    t1.start();
    t2.start();
  }
}
