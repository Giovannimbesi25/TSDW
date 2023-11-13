import java.io.*;
import java.net.*;

public class Client {
  public static final String historyKey = "SHOW";
  
  public static void main(String[] args){

    InetAddress addr;

    try {
      if (args.length == 0) 
        addr = InetAddress.getByName(null);
      else 
        addr = InetAddress.getByName(args[0]);
    } catch (UnknownHostException e) {
      System.out.println("Invalid host: " + e.getMessage());
      return;
    }

    Socket socket = null;
    BufferedReader in , stdin = null;
    PrintWriter out = null;

    try{
      socket = new Socket(addr, Server_E.PORT);
      in = new BufferedReader(new InputStreamReader(socket.getInputStream()));
      stdin = new BufferedReader(new InputStreamReader(System.in));
      out = new PrintWriter(socket.getOutputStream(), true);

      System.out.println("Client socket started "+socket);
      try{
        while (true) {
            String inputString = stdin.readLine();
            out.println(inputString);
            String response = in.readLine();
            System.out.println("Server_E: " + response);
        }
        
      }catch(IOException e) {e.printStackTrace();}

    }catch(IOException e){
      e.printStackTrace();
    }

  }
}
