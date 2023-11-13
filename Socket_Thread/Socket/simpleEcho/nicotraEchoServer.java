import java.io.*;
import java.net.*;

public class nicotraEchoServer {
  
  public static final int PORT = 1050;
  public static final String SECRET = "end";

  public static void main(String[] args){
    ServerSocket serverSocket = null;

    try {
      serverSocket = new ServerSocket(PORT);
    } catch (IOException e) {
      e.printStackTrace();
    }

    System.out.println("EchoServer: start");
    System.out.println("ServerSocket: "+serverSocket);

    Socket clientSocket=null;
    BufferedReader in= null;
    PrintWriter out= null;

    try{

      clientSocket = serverSocket.accept();
      System.out.println("Connection accepted: "+clientSocket);
      in = new BufferedReader(new InputStreamReader(clientSocket.getInputStream()));
      out = new PrintWriter(clientSocket.getOutputStream(), true);

      String inputLine;

      while((inputLine = in.readLine()) != null){
        if(inputLine.equals(SECRET)){
          System.out.println("Received SECRET phrase");
          out.println(inputLine+" received");
          break;
        }
        System.out.println("Echoing: "+inputLine);
        out.println(inputLine);
      }

    }
    catch(IOException e){
      System.err.println("Accept failed");
      System.exit(1);
    }

    System.out.println("EchoServer: closing...");

    try{
      out.close();
      in.close();
      clientSocket.close();
      serverSocket.close();
    }
    catch(IOException e){
      System.out.println("Errorclosing...");
      e.printStackTrace();
    }
  }
}
