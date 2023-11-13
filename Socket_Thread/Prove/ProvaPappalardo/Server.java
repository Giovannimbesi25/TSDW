import java.io.*;
import java.net.*;

public class Server{
  private static final int PORT = 3333;

  public static void main(String[] args){
    ServerSocket serverSocket = null;

    try{
      serverSocket = new ServerSocket(PORT);
    }catch(IOException e){
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
        System.out.println("New connection: "+clientSocket);
        in = new BufferedReader(new InputStreamReader(clientSocket.getInputStream()));
        out = new PrintWriter(clientSocket.getOutputStream(), true);
        while(true){
          String clientString = in.readLine();

          if(clientString != null){
            System.out.println("Received: "+clientString);
            out.println(check(clientString));
          }else{
            break;
          }
        }
      }catch(IOException e){e.printStackTrace();}
    }
  }

  public static String check(String clientString){
    Boolean condition = true;
    for(char c : clientString.toCharArray()){
      if(c != 'V') condition = false;
    }
    if(condition) return "Vero";
    else return "Falso";
  }
}
