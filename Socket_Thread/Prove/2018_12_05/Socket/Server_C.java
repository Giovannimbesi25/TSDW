import java.io.*;
import java.net.*;

public class Server_C{
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

    Socket clientSocket = null;
    BufferedReader in = null;
    PrintWriter out = null;

    try{
      while(true){
        System.out.println("Waiting for new connection...");

        clientSocket=serverSocket.accept();
        in = new BufferedReader(new InputStreamReader(clientSocket.getInputStream()));
        out = new PrintWriter(clientSocket.getOutputStream(), true);

          try{
            String receivedString;
            //istruzione fondamentale: blocca la socket sino a quando il client è connesso
            while((receivedString = in.readLine()) != null){
              System.out.println("Server_C received: "+ receivedString);
              out.println("Server_C echo: " + list(receivedString));
            }
          }catch(IOException e){e.printStackTrace();}
        }
    }catch(IOException e){e.printStackTrace();}
  }

  public static String list(String s){
    return s;
  }

}