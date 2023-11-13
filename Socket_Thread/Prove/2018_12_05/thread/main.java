public class main {

  public static void main(String[] args){
    System.out.println("Avvio");

    Shared sharedMem = new Shared();

    ThreadP p = new ThreadP("P",sharedMem);

    ThreadD d = new ThreadD("D", sharedMem);

    p.start();
    d.start();

  }

}
