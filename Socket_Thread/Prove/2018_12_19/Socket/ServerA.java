import java.io.*;
import java.net.*;

public class ServerA {
  private static final int PORT = 7777;

  public static void main(String[] args){

    ServerSocket serverSocket = null;

    try{
      serverSocket = new ServerSocket(PORT);
      System.out.println("Server_A: started");
    }catch(IOException e){e.printStackTrace();}

    Socket clientSocket = null;
    BufferedReader in = null;

    try{
      System.out.println("Waiting for connection...");
      clientSocket = serverSocket.accept();
      in = new BufferedReader(new InputStreamReader(clientSocket.getInputStream()));

      try{
        String clientString = in.readLine();
        if (isValidNumericString(clientString)) {
          System.out.println("Messaggio ricevuto: " + clientString);
        } else {
            System.out.println("Messaggio non valido: " + clientString);
        }
      }catch(IOException e){e.printStackTrace();}
    }catch(IOException e){e.printStackTrace();}
  }

  private static boolean isValidNumericString(String str) {
    return str.matches("^[0-9]+\\n$");
  }
}