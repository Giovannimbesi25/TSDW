import java.io.*;
import java.net.*;

public class MainServer_F{
  public static final int PORT = 3333;

  public static void main(String[] args){
    ServerSocket serverSocket = null;
    try{
     serverSocket = new ServerSocket(PORT);
     System.out.println("Server_F: start");
     System.out.println("Server_F: "+serverSocket);
    }catch(IOException e){
       e.printStackTrace();
    }

    Socket clientSocket = null;


    try{
      while(true){
        System.out.println("Waiting for new connection...");
        clientSocket=serverSocket.accept();
        new Thread_Server_F(clientSocket);

      }
    }catch(IOException e){e.printStackTrace();}

    try{
      System.out.println("Server_F closing...");
      serverSocket.close();
    }catch(IOException e){}
  }
}