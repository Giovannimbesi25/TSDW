import java.io.*;
import java.net.*;

public class ServerA {
  private static final int PORT = 3333;

  public static void main(String[] args){
    ServerSocket serverSocket = null;

    System.out.println("ServerA: started...");
    try{
      serverSocket = new ServerSocket(PORT);
    }catch(IOException e){e.printStackTrace();}

    Socket clientSocket = null;
    BufferedReader in = null;
    
    try{
      while(true){
        System.out.println("In attesa di una nuova connessione");

        
        clientSocket = serverSocket.accept();
        System.out.println("Connessione avvenuta "+clientSocket);
        in = new BufferedReader(new InputStreamReader(clientSocket.getInputStream()));

        String clientString = in.readLine();
        System.out.println("Echo->>"+clientString);

        try{
          clientSocket.close();
          in.close();
        }catch(IOException e){e.printStackTrace();}
      }
    }
    catch(IOException e) {e.printStackTrace();}
  }
}
