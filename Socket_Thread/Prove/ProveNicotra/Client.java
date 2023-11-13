import java.io.*;
import java.net.*;

public class Client {
  public static final int PORT = 3333;

  public static void main(String[] args){
    InetAddress addr = null;

    try{
      if(args.length > 0) addr = InetAddress.getByName(args[0]);
      else addr = InetAddress.getByName(null);
    }catch(UnknownHostException e){System.exit(1);}

    Socket socket = null;
    BufferedReader in = null;
    BufferedReader stdin = null;
    PrintWriter out = null;

    try{
      socket = new Socket(addr, PORT);
      in = new BufferedReader(new InputStreamReader(socket.getInputStream()));
      stdin = new BufferedReader(new InputStreamReader(System.in));
      out = new PrintWriter(socket.getOutputStream(), true);
      System.out.println("Client started...");


      while(true){
        System.out.println("Insert an integer...");
        String clientString = stdin.readLine();
        out.println(clientString);
        String serverString = in.readLine();
        System.out.println("Server: "+serverString);
     
      }
    }catch(IOException e){e.printStackTrace();}

  }
}
