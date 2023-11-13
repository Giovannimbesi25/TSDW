import java.io.*;
import java.net.*;

public class Server_E{
  public static final int PORT = 3333;
  public static String history = "";

  public static void main(String[] args){
    ServerSocket serverSocket = null;
    try{
     serverSocket = new ServerSocket(PORT);
     System.out.println("Server_E: start");
     System.out.println("Server_E: "+serverSocket);
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

        System.out.println("New connection with "+ clientSocket);
        in = new BufferedReader(new InputStreamReader(clientSocket.getInputStream()));
        out = new PrintWriter(clientSocket.getOutputStream(), true);

          try{
            String receivedString;
            //istruzione fondamentale: blocca la socket sino a quando il client è connesso
            while((receivedString = in.readLine()) != null){
              System.out.println("Server_E received: "+ receivedString);
              out.println(list(receivedString));
            }
          }catch(IOException e){e.printStackTrace();}
        }
    }catch(IOException e){e.printStackTrace();}

    try{
      System.out.println("Server_E closing...");
      serverSocket.close();
      in.close();
      out.close();
    }catch(IOException e){}
  }


  public static String list(String s) {
    s = s.trim();
    if (s.equals("SHOW") || s.equals("SHOW\n")) {
        return history;
    }
    history += s + ";";
    return "OK";
}


}