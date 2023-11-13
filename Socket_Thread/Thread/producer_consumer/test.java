public class test {
    public static void main(String[] args) {
        container containerIstance = new container();
        producer p1 = new producer(containerIstance);
        consumer c1 = new consumer(containerIstance, "c1");
        p1.start();
      
        c1.start();

    }
}