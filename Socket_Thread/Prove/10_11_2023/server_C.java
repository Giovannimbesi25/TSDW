import java.io.*;
import java.net.*;

public class server_C{
  private static final int  PORT = 3333;
  private static String longestString = "";

  public static void main(String[] args){
    ServerSocket serverSocket = null;

    try{
      serverSocket = new ServerSocket(PORT);
      System.out.println("ServerA started...");
    }catch(IOException e) {
      e.printStackTrace();
      System.exit(1);
    }

    Socket clientSocket = null;
    BufferedReader in = null;
    PrintWriter out = null;

    
    while(true){
      System.out.println("Waiting for new connection...");

      try{
        clientSocket = serverSocket.accept();
        in = new BufferedReader(new InputStreamReader(clientSocket.getInputStream()));
        out = new PrintWriter(clientSocket.getOutputStream(), true);
        System.out.println("New connection started "+clientSocket);
        String clientString = in.readLine();

        if(clientString != null){
          System.out.println("Received: "+ clientString);
          if(clientString.length() > longestString.length()){
            longestString = clientString;
          }
          out.println(longestString);

        }

        try{
          clientSocket.close();
          in.close();
        }catch(IOException e){
          e.printStackTrace();
        }
      }catch(IOException e){e.printStackTrace();}
    }
    

  }
}