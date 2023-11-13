import java.io.*;
import java.net.*;

public class server_A{
  private static final int PORT = 3333;

  public static void main(String[] args){

    ServerSocket serverSocket = null;

    try{
      serverSocket = new ServerSocket(PORT);
      System.out.println("sever_A: started...");
    }catch(IOException e){
      e.printStackTrace();
      System.exit(1);
    }

    Socket clientSocket = null;
    BufferedReader in = null;

    while(true){
      try{
        clientSocket = serverSocket.accept();
        in = new BufferedReader(new InputStreamReader(clientSocket.getInputStream()));
        System.out.println("New connection with "+clientSocket);
        String clientString;
        if((clientString = in.readLine()) != null){
          System.out.println("Received: "+ clientString);
        }
      }catch(IOException e){
        e.printStackTrace();
        System.exit(1);
      }

      try{
        clientSocket.close();
        in.close();
      }catch(IOException e){
        e.printStackTrace();
        System.exit(1);
      }
    }
  }
}