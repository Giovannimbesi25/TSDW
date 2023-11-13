import java.io.*;
import java.net.*;

public class Server{
  private static final int PORT = 3333;

  public static void main(String[] args){
    ServerSocket serverSocket = null;

    try{
      serverSocket = new ServerSocket(PORT);
      System.out.println("Server started...");
    }catch(IOException e){e.printStackTrace();}

    Socket clientSocket = null;
    BufferedReader in = null;
    PrintWriter out = null;

    System.out.println("Waiting for new connection...");
    try {
      clientSocket = serverSocket.accept();
      in = new BufferedReader(new InputStreamReader(clientSocket.getInputStream()));
      out = new PrintWriter(clientSocket.getOutputStream(), true);
      System.out.println("Client connected: "+clientSocket);
      String clientString = null;
      while((clientString = in.readLine()) != null){
        if(clientString.matches("^[0-9]+"))
          out.println(cubo(Integer.parseInt(clientString)));
        else{
          out.println("Can't handle string");
        }
      }
    } catch (Exception e) {e.printStackTrace();}
    System.out.println("Connection closed");
  }
  

  public static int cubo(int n){
    return n*n*n;
  }



  
}