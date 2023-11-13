import java.io.*;
import java.net.*;

public class ServerC {
  private static final int PORT = 3333;
  private static String lastString = "";

  public static void main(String[] args){
    ServerSocket serverSocket = null;

    System.out.println("ServerC: started...");
    try{
      serverSocket = new ServerSocket(PORT);
    }catch(IOException e){e.printStackTrace();}

    Socket clientSocket = null;
    BufferedReader in = null;
    PrintWriter out = null;

    try{
      while(true){
        System.out.println("In attesa di una nuova connessione");

        
        clientSocket = serverSocket.accept();
        System.out.println("Connessione avvenuta "+clientSocket);
        in = new BufferedReader(new InputStreamReader(clientSocket.getInputStream()));
        out = new PrintWriter(clientSocket.getOutputStream(), true);
        
        String clientString = in.readLine();
        if(clientString != null) {
          System.out.println("Echo->>"+clientString);
          if(cominciaPerVocale(clientString)){
            lastString = clientString;
          }
          out.println(lastString);
        }

        
    
        try{
          clientSocket.close();
          in.close();
        }catch(IOException e){e.printStackTrace();}
      }
    }
    catch(IOException e) {e.printStackTrace();}
  }

  public static boolean cominciaPerVocale(String str){
    switch(Character.toLowerCase(str.charAt(0))){
      case 'a':
      case 'e':
      case 'i':
      case 'o':
      case 'u':
        return true;
      default:
        return false;
    }
  }
}
