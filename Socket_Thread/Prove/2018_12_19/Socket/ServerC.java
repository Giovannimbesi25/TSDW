import java.io.*;
import java.net.*;

public class ServerC {
  private static final int PORT = 7777;

  public static void main(String[] args){

    ServerSocket serverSocket = null;

    try{
      serverSocket = new ServerSocket(PORT);
      System.out.println("Server_C: started");
    }catch(IOException e){e.printStackTrace();}

    Socket clientSocket = null;
    BufferedReader in = null;
    PrintWriter out = null;

    try{
      System.out.println("Waiting for connection...");
      clientSocket = serverSocket.accept();
      in = new BufferedReader(new InputStreamReader(clientSocket.getInputStream()));
      out = new PrintWriter(clientSocket.getOutputStream(), true);
      try{
        String clientString = in.readLine();
        if (clientString != null && clientString.matches("[0-9]+")) {
          System.out.println("Server_C: ricevuto-> " + (clientString));
          out.println(MUL(clientString));
        } else {
          System.out.println("Server_C: Ricevuta una stringa non valida.");
          out.println("Stringa non valida");
        }
      }catch(IOException e){e.printStackTrace();}
    }catch(IOException e){e.printStackTrace();}
  }

  public static int MUL(String str){
    return 0;
  }

}