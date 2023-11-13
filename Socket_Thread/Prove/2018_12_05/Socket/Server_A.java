import java.io.*;
import java.net.*;

public class Server_A{
  public static final int PORT = 3333;


  public static void main(String[] args){
    ServerSocket serverSocket = null;
    try{
     serverSocket = new ServerSocket(PORT);
     System.out.println("Server_A: start");
     System.out.println("Server_A: "+serverSocket);
    }catch(IOException e){
       e.printStackTrace();
    }

    Socket clientSocket=null;
    BufferedReader in=null;

    try{
      while(true){
        System.out.println("Waiting for new connection...");

        clientSocket=serverSocket.accept();
        in = new BufferedReader(new InputStreamReader(clientSocket.getInputStream()));

          try{
            String receivedString;
            //istruzione fondamentale: blocca la socket sino a quando il client è connesso
            while((receivedString = in.readLine()) != null){
              System.out.println("Server_A received: "+ receivedString);
            }
          }catch(IOException e){e.printStackTrace();}
        }
    }catch(IOException e){e.printStackTrace();}
  }

}